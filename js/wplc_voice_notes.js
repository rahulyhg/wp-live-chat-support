(function($){
    navigator.getUserMedia =
        navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia;

    var audioContext = new AudioContext;
    if (audioContext.createScriptProcessor == null)
        audioContext.createScriptProcessor = audioContext.createJavaScriptNode;

    var $voiceNotes = $('.wplc-voice-notes'),
        $recording = $('#recording'),
        $recordingList = $('#wplc-voice-notes__recording-list');

    var microphone = undefined,
        microphoneLevel = audioContext.createGain(),
        mixer = audioContext.createGain();
    microphoneLevel.connect(mixer);
    mixer.connect(audioContext.destination);

    var keys = {
        space: false,
        ctrl: false
    };

    if (microphone == null)
        navigator.getUserMedia({ audio: true },
            function(stream) {
                microphone = audioContext.createMediaStreamSource(stream);
                microphone.connect(microphoneLevel);
                stream.getAudioTracks()[0].enabled = false;

                window.addEventListener('keydown', function(e) {
                    if (e.keyCode === 17) {
                        keys['ctrl'] = true;
                    } else if (e.keyCode === 32) {
                        keys['space'] = true;
                    }

                    if (keys['ctrl'] && keys['space']) {
                        stream.getAudioTracks()[0].enabled = true;
                        if (!audioRecorder.isRecording()) {
                            startRecording();
                        }
                    }
                });

                window.addEventListener('keyup', function(e) {
                    if (e.keyCode === 17) {
                        keys['ctrl'] = false;
                    } else if (e.keyCode === 32) {
                        keys['space'] = false;
                    }
                    if (keys['ctrl'] === false && keys['space'] === false) {
                        if (audioRecorder.isRecording()) {
                            stopRecording(true);
                            stream.getAudioTracks()[0].enabled = false;
                        }
                    }
                });
            },
            function(error) {
                if (typeof $microphone !== 'undefined') {
                    $microphone[0].checked = false;
                }
                audioRecorder.onError(audioRecorder, "Could not get audio input.");
            });

// audio recorder object
    var audioRecorder = new WebAudioRecorder(mixer, {
        workerDir: wplc_user_voice.plugin_url
    });

// encoding process selector
    var encodingProcess = 'background';

// save/delete recording
    function saveRecording(blob, encoding) {
        var time = new Date(),
            url = URL.createObjectURL(blob),
            html = "<p recording='" + url + "'>" +
                "<audio controls src='" + url + "'></audio> " +
                " (" + encoding.toUpperCase() + ") " +
                time +
                " <a class='btn btn-default' href='" + url +
                "' download='recording." +
                encoding +
                "'>" + wplc_user_voice.str_save + "</a> " +
                "<button class='btn btn-danger' recording='" +
                url +
                "'>" + wplc_user_voice.str_delete + "</button>" +
                "</p>";
        $recordingList.prepend($(html));

        var fd = new FormData();
        fd.append('file', blob);
        fd.append('action', 'wplc_save_voice_notes');
        $.ajax({
            url: wplc_user_voice.ajax_url,
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#inputMessage').val(data);
            }
        });
    }

    $recordingList.on('click', 'button', function(event) {
        var url = $(event.target).attr('recording');
        $("p[recording='" + url + "']").remove();
        URL.revokeObjectURL(url);
        $voiceNotes.removeClass('is-active');
    });

// encoding progress report modal
    var progressComplete = false;

    function startRecording() {
        $recording.removeClass('hidden');
        audioRecorder.setOptions({
            timeLimit: 120,
            encodeAfterRecord: true
        });
        audioRecorder.startRecording();
    }

    function stopRecording(finish) {
        $recording.addClass('hidden');
        if (finish) {
            audioRecorder.finishRecording();
        } else
            audioRecorder.cancelRecording();
    }

// event handlers
    audioRecorder.onTimeout = function(recorder) {
        stopRecording(true);
    };

    audioRecorder.onComplete = function(recorder, blob) {
        saveRecording(blob, recorder.encoding);
        $voiceNotes.addClass('is-active');
    };

    $('.wplc-voice-notes__close').on('click', function () {
        $voiceNotes.removeClass('is-active');
    });
})(jQuery);