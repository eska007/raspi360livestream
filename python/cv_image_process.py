import cv2
import numpy as np
import os
import Image
import time
# Must be enable v4l2 driver
# modprobe bcm2835-v4l2 #/dev/video0


def buildMap(Ws,Hs,Wd,Hd,R1,R2,Cx,Cy):
    map_x = np.zeros((Hd,Wd),np.float32)
    map_y = np.zeros((Hd,Wd),np.float32)
    
    rMap = np.linspace(R1, R1 + (R2 - R1), Hd)
    thetaMap = np.linspace(0, 0 + float(Wd) * 2.0 * np.pi, Wd)
    sinMap = np.sin(thetaMap)
    cosMap = np.cos(thetaMap)

    for y in xrange(0, int(Hd-1)):
        map_x[y] = Cx + rMap[y] * sinMap
        map_y[y] = Cy + rMap[y] * cosMap

    return map_x, map_y

def unwarp(img, xmap, ymap):
    return cv2.remap(img, xmap, ymap, cv2.INTER_LINEAR) 

def dewarp(img, Cx=332, Cy=220, R1x=388, R2x=443): # Default (640*480)
    R1 = R1x - Cx
    R2 = R2x - Cx
    #print(R1, R2) 
    Wd = round(float(max(R1, R2)) * 2.0 * np.pi)
    Hd = R2 - R1
    
    # Size of Image
    Ws = cap.get(cv2.CAP_PROP_FRAME_WIDTH)#img.width
    Hs = cap.get(cv2.CAP_PROP_FRAME_HEIGHT)#img.height

    # Building Map
    xmap, ymap = buildMap(Ws,Hs,Wd,Hd,R1,R2,Cx,Cy)

    # Unwarp
    result = unwarp(img, xmap, ymap)
    return result


def set_cv_frame_res(cap, x,y):
    cap.set(cv2.CAP_PROP_FRAME_WIDTH, int(x))
    cap.set(cv2.CAP_PROP_FRAME_HEIGHT, int(y))
    return str(cap.get(cv2.CAP_PROP_FRAME_WIDTH)),str(cap.get(cv2.CAP_PROP_FRAME_HEIGHT))

cap = cv2.VideoCapture(0)
ws, hs = set_cv_frame_res(cap, 1280, 720)
print ("Set frame resolution: " + ws + ',' + hs)

ext = '.avi'
codec = 'XVID' #OK

# OPENCV 3.1.0
fourcc = cv2.VideoWriter_fourcc(*codec)
out = cv2.VideoWriter('/var/www/html/files/' + codec + ext, fourcc, 1, (1244, 107)) # O.K
filename = '/var/www/html/files/stream.png'

while(True):
    ret, frame = cap.read()
    if ret:
        #dewarp_img = dewarp(frame, 685, 315, 776, 883) # Image tuning
	dewarp_img = dewarp(frame, 665, 315, 785, 870)
        dewarp_img = cv2.resize(dewarp_img, (1280, 480))
	
        cv2.imwrite(filename, dewarp_img)
    	#h, w, l = dewarp_img.shape
    	#print(w, h)
	out.write(dewarp_img)
    	time.sleep(1)

    c = cv2.waitKey(7) % 0x100
    if c == 27 or c == 10:
        print('Stop recording..')
        break 
 
out.release()
cap.release()
