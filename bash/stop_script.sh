#!/bin/bash
sudo killall python
sudo ps aux | grep -i mjpg_streame[r] | awk {'print $2'} | xargs kill -9
sudo ps aux | grep -i raspivi[d] | awk {'print $2'} | xargs kill -9
