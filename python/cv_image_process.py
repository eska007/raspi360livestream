from SimpleCV import *
import numpy as np
import cv2
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
    output = cv2.remap(img.getNumpyCv2(), xmap, ymap, cv2.INTER_LINEAR) 
    result = Image(output, cv2image=True)
    return result

def dewarp(img, Cx=332, Cy=220, R1x=388, R2x=443): # Default (640*480)
    R1 = R1x - Cx
    R2 = R2x - Cx
    #print(R1, R2) 
    Wd = round(float(max(R1, R2)) * 2.0 * np.pi)
    Hd = R2 - R1
    
    # Size of Image
    Ws = img.width
    Hs = img.height

    # Building Map
    xmap, ymap = buildMap(Ws,Hs,Wd,Hd,R1,R2,Cx,Cy)

    # Unwarp
    result = unwarp(img, xmap, ymap)
    return result


cam = Camera(0, {"width": 1280, "height": 720})
while(True):
    img = cam.getImage()
    dewarp_img = dewarp(img, 685, 315, 776, 883) # 1280*720
    dewarp_img.save("/var/www/html/files/stream.png")
    time.sleep(1)

 

