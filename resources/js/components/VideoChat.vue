
<template>
    <div class="p-5">

        <h1 class="text-2xl mb-4">DoctorUK Live Video Chat </h1>
        <div id ="users">
        </div>
        <div id="myid" class="grid grid-flow-row grid-cols-3 grid-rows-3 gap-4 bg-black/]">
            <div id="video-chat-window">
            </div>

            <!-- <button v-on:click="disconnectToRoom" class="btn btn-info">close session</button> -->
        </div>

    </div>
</template>
<style>
    video {
        /* border:5px solid #4b5eba; */
        /* border-radius:10px; */
        /* height:400px; */
        /* width:22%; */
        /* height: 84%;
    width: 100%; */
        height: 60%;
        width: 100%;
        object-fit: cover;
    }
</style>

<script>
require('./twilio-video-processors.min.js');
// require('./twilio-video.min.js');


export default {
    name: 'video-chat',
    data() {
            return { 
                roomsArray:[],
                roomIndex:0,
            };
        },
    methods : {
        getAccessToken : function () {

            const _this = this
            const axios = require('axios')
            const urlParams = new URLSearchParams(window.location.search);
            const doctor_name = urlParams.get('doctor_name');
            const rommId = urlParams.get('rommId');

            axios.post(`https://certiflyapi.massolabs.com/doctoruk/public/api/access_token`, {
                accountSid: 'AC705d9a8ba5109dad027f5a4beb297d9b',
                apiKeySid: 'SK0dcc632dae36f60b190a54db18557076',
                apiKeySecret: 'CaSuqx0biPUiy6WX5ynDHg6u1Pci9W9y',
                identity: doctor_name,
                room_name:rommId
             })
                .then(function (response) {
                    console.log(response.data)
                    _this.accessToken = response.data.token
                    _this.room_name = response.data.room_name
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                    _this.connectToRoom()
                    // _this.localTrack()
                });
        },
        // connect to room
        connectToRoom : function () {
            const { connect, createLocalVideoTrack } = require('twilio-video');
            var videoChatWindow = document.getElementById('video-chat-window');
            connect(this.accessToken, { name:this.room_name }).then(room => {
                var participantdiv = document.createElement("div");
                participantdiv.classList.add('col-md-6');
                participantdiv.style = "position:relative;border: 5px solid;";
                participantdiv.classList.add('embed-responsive');
                participantdiv.classList.add('embed-responsive-16by9');
                videoChatWindow.appendChild(participantdiv);

                var waitingImg = document.createElement("img");
                waitingImg.style = "padding-left:26px";  
                waitingImg.style = "width:230px; margin-top: -45%;";
                                    
                waitingImg.src = "https://thumbs.dreamstime.com/b/danger-icon-vector-male-person-profile-avatar-symbol-alert-sign-glyph-pictogram-illustration-166222578.jpg";
                            
                participantdiv.appendChild(waitingImg); 
                
                var callDisc = document.createElement("i");
                    callDisc.style="font-size: 30px; margin-left:50%; color:#de3c1f; padding-right:8px;padding-top:10px;position:relative";
                    callDisc.classList.add("fa");
                    callDisc.classList.add('fa-phone-square');
                    callDisc.id = 'ssid_call_disconnect';                    
                    participantdiv.appendChild(callDisc);
                this.roomsArray.push(room);
                room.on('participantConnected', participant => {
                    console.log(`Participant "${participant.identity}" connected`);
                    
                    callDisc.onclick = function(ev) {
                        let status = this.id;
                        if(this.id == "false"){
                            this.id = "true"; 
                            room.localParticipant.audioTracks.forEach(function(track) {
                                track.track.disable();
                            });
                        } 
                    }
                    callDisc.disable = "true";
                    callDisc.onclick = function(env) { 
                        
                        var r = confirm("Are you sure you want to end this call?"); 
                        if (r === false) {
                           return false;
                        }else{  
                            // axios.get('/api/callEnd?id='+id+"&verifier=verifier")
                            // .then(response => {
                            //     console.log(response.data) 
                            // })
                            // .catch(function (error) {
                            //     console.log(error);
                            // });
                            room.localParticipant.tracks.forEach(publication => {
                              publication.track.stop();  
                            }); 
                            // this.parentElement.parentElement.nextElementSibling.remove();
                            // this.parentElement.parentElement.remove(); 
                            // document.getElementById(id).remove(); 
                            room.disconnect(); 
                             
                        }
                        
                    }

                    participant.tracks.forEach(publication => {
                        if (publication.isSubscribed) {
                            const track = publication.track;
                            participantdiv.appendChild(track.attach())
                            videoChatWindow.appendChild(participantdiv);
                            document.getElementById('ssid_call_disconnect').remove();
                            callDisc.disable = "false";
                            participantdiv.appendChild(callDisc);
                        }
                    });
                    participant.on('trackSubscribed', track => {
                        participantdiv.appendChild(track.attach())
                        videoChatWindow.appendChild(participantdiv);
                        document.getElementById('ssid_call_disconnect').remove();
                        callDisc.disable = "false";
                        participantdiv.appendChild(callDisc);
                    });

                    

                });

                room.participants.forEach(participant => {
                    participant.tracks.forEach(publication => {
                        if (publication.track) {
                            participantdiv.appendChild(publication.track.attach());
                        }
                    });
                    participant.on('trackSubscribed', track => {
                        participantdiv.appendChild(track.attach());
                    });
                });



                // var mic = document.createElement("i");
                // mic.style="font-size: 30px; padding-left:10px; padding-right:10px;color:lightgray;padding-top:10px;position:relative";
                // mic.classList.add("fa");
                // mic.classList.add('fa-microphone');
                // mic.id = "false";
                // mic.onclick = function(ev) {
                //     let status = this.id;
                //     if(this.id == "false"){
                //        this.id = "true";
                //        this.style.color = "gray";
                //        room.localParticipant.audioTracks.forEach(function(track) {
                //         track.track.disable();
                //        });
                //     }else if(this.id == "true"){
                //         this.id = "false";
                //         this.style.color = "lightgray";
                //         room.localParticipant.audioTracks.forEach(function(track) {
                //             track.track.enable();
                //         });
                //     }

                // }


                

                // var cam = document.createElement("i");
                // cam.style="font-size: 30px;color:lightgray; padding-right:8px;padding-top:10px;position:relative";
                // cam.classList.add("fa");
                // cam.classList.add('fa-camera');
                // cam.id = 'false';
                // cam.onclick = function(ev) {
                //     let status = this.id;
                //     if(this.id == "false"){
                //         this.id = "true";
                //         this.style.color = "gray";
                //         room.localParticipant.audioTracks.forEach(function(track) {
                //             track.track.disable();
                //         });
                //     }else if(this.id == "true"){
                //         this.id = "false";
                //         this.style.color = "lightgray";
                //         room.localParticipant.audioTracks.forEach(function(track) {
                //             track.track.enable();
                //         });
                //     }
                // }

                // participantdiv.appendChild(mic);                
                // participantdiv.appendChild(cam);
                

            }, error => {
                console.error(`Unable to connect to Room: ${error.message}`);
            });
        },
        connectLocalTrack : function(){
            const { connect, createLocalVideoTrack } = require('twilio-video');
            const videoChatWindow = document.getElementById('video-chat-window');
            var localdiv = document.createElement("div");
            
            console.log('local camera connect successfully');
            var tr;
            var videoTrack =  createLocalVideoTrack().then(track => {
                const bg = new Twilio.VideoProcessors.GaussianBlurBackgroundProcessor({
                assetsPath: '/',
                maskBlurRadius: 10,
                blurFilterRadius: 5,
            });
            bg.loadModel();
            track.addProcessor(bg); 
                localdiv.appendChild(track.attach());

                localdiv.classList.add('col-md-6');
                localdiv.style = "position:relative;float:left;border: 5px solid;";
                localdiv.classList.add('embed-responsive');
                localdiv.classList.add('embed-responsive-16by9');

                var mic = document.createElement("i");
                mic.style="font-size: 30px; padding-left:10px; padding-right:10px;color:#2196f3;padding-top:10px;position:relative";
                mic.classList.add("fa");
                mic.classList.add('fa-microphone');
                mic.id = "false";
                mic.title = this.roomsArray;
                mic.data = this.roomsArray;
                mic.onclick = function(ev) {
                    let status = this.id;
                    if(this.id == "false"){
                        this.id = "true"; 
                        this.classList.remove("fa-microphone");;
                        this.classList.add('fa-microphone-slash'); 
                        for (var i = this.data.length - 1; i >= 0; i--) {   
                            this.data[i].localParticipant.audioTracks.forEach(function(track) {
                                track.track.disable();                                 
                            });
                        } 
                    }else if(this.id == "true"){
                        this.id = "false"; 
                        this.classList.remove('fa-microphone-slash'); 
                        this.classList.add("fa-microphone");
                       
                        for (var i = this.data.length - 1; i >= 0; i--) {
                            this.data[i].localParticipant.audioTracks.forEach(function(track) {
                                track.track.enable();                                 
                            });
                        } 
                    }

                }
                
                var cam = document.createElement("i");
                cam.style="font-size: 30px;color:#2196f3; padding-right:8px;padding-top:10px;position:relative";
                cam.classList.add("fa");
                cam.classList.add('fa-video');
                cam.id = 'false';
                cam.title = this.roomsArray;
                cam.data = this.roomsArray;
                cam.onclick = function(ev) {
                    let status = this.id;
                    if(this.id == "false"){
                        this.id = "true";
                        this.classList.remove("fa-video");;
                        this.classList.add('fa-video-slash'); 
                        for (var i = this.data.length - 1; i >= 0; i--) {   
                            this.data[i].localParticipant.videoTracks.forEach(function(track) {
                                track.track.disable();                                 
                            });
                        } 
                    }else if(this.id == "true"){
                        this.id = "false"; 
                        this.classList.remove('fa-video-slash');
                        this.classList.add("fa-video");
                         
                        for (var i = this.data.length - 1; i >= 0; i--) {   
                            this.data[i].localParticipant.videoTracks.forEach(function(track) {
                                track.track.enable();                                 
                            });
                        }
                    }
                }


                var callDisc = document.createElement("i");
                callDisc.style="font-size: 30px;color:lightgray; padding-right:8px;padding-top:10px;position:relative";
                callDisc.classList.add("fa");
                callDisc.classList.add('fa-phone');
                callDisc.id = 'ssid';
               
                

                localdiv.appendChild(mic);                
                localdiv.appendChild(cam); 
                videoChatWindow.appendChild(localdiv);
            });
        
            
        },

    },
    mounted : function () {
        console.log('Video chat room loading...')
        this.connectLocalTrack();
        this.getAccessToken();
    }
}
</script>