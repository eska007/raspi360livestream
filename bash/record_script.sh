#!/bin/bash
sudo sh stop_script.sh
#raspivid -o - -t 0 | tee /var/www/html/vid_files/video1.h264 | avconv -re -i rtsp://192.168.0.15:8080 -r 20 -b 750 -f flv rtmp://a.rtmp.youtube.com/live2/6d0y-mpwb-pr0x-1vwb
#161018_1: avconv -ar 44100 -ac 2 -f s16le -i /dev/zero -f video4linux2 -s 640x360 -r 10 -i /dev/video0 -f flv -c:v libx264 -c:a copy "rtmp://a.rtmp.youtube.com/live2/ej6m-f5uj-52qt-bsz9"
#161018_2 avconv -ar 44100 -ac 2 -f s16le -i /dev/zero -f video4linux2 -s 426X240 -r 30 -i /dev/video0 -f flv -c:v libx264 -g 2 -keyint_min 2 -c:a libmp3lame "rtmp://a.rtmp.youtube.com/live2/73mv-4v9f-x063-ezep"
#raspivid -w 1920 -h 1080 -fps 24 -t 5000 -o /var/www/html/vid_files/video.h264
raspivid -md 5 -t 5000 -o /var/www/html/files/video.h264
#echo "Recording is done .."
