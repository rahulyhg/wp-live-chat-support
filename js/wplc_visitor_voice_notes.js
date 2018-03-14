(function($){

    setTimeout(function () {
        $('#wplc_start_chat_btn').on('click', initVoiceNotes);

        $(document).on("wplc_animation_done", function(e) {
            var chatStatus = Cookies.get('nc_status');
            if (chatStatus !== 'undefined' && chatStatus === 'active') {
                initVoiceNotes();
            }
        });

        function initVoiceNotes() {
            navigator.getUserMedia =
                navigator.getUserMedia ||
                navigator.webkitGetUserMedia ||
                navigator.mozGetUserMedia ||
                navigator.msGetUserMedia;

            var audioContext = new AudioContext;
            if (audioContext.createScriptProcessor == null)
                audioContext.createScriptProcessor = audioContext.createJavaScriptNode;

            var chatIcon = $('#wp-live-chat-header');

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
                workerDir: wplc_visitor_voice.plugin_url
            });

            // encoding process selector
            var encodingProcess = 'background';

            // save/delete recording
            function saveRecording(blob, encoding) {
                var fd = new FormData();
                fd.append('file', blob);
                fd.append('action', 'wplc_save_voice_notes');
                $.ajax({
                    url: wplc_visitor_voice.ajax_url,
                    type: 'POST',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('#wplc_chatmsg').val(data);
                    }
                });
            }

            // encoding progress report modal
            var progressComplete = false;

            function startRecording() {
                chatIcon.addClass('is-recording');
                audioRecorder.setOptions({
                    timeLimit: 120,
                    encodeAfterRecord: true
                });
                audioRecorder.startRecording();
            }

            function stopRecording(finish) {
                chatIcon.removeClass('is-recording');
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
                chatIcon.removeClass('is-recording');
            };
        }
    }, 500);

})(jQuery);