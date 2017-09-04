﻿/**
 * Local image cacher, to loading images fasting
 *
 * @package   Smart Dealership, Apollo14 Framework (c)
 * @author    Patrick Otto <patrick@smartdealership.com.br>
 * @author    Jean Carlos dos Santos <jean@smartdealership.com.br>
 * @version   2.0.1
 * @copyright Smart Dealer (c), Sept 2014-2017
 * @see       http://smartdealer.com.br
 */

INSTALLATION STEPS 

1. Copy all files to the folder that will be the repository module (your server)
2. Enable "rewrite.mod" module on Apache settings and reload services
3. Set "775" read/write permissions on folder "cache"
4. Test the loading of images

Good Look!

TESTE LOADING

{host} : My Host, ex: www.google.com.br
{cache-folder} : The cacher respository, ex: getimage
{owner} : Instance/cliente name, ex: prima
 
http://{host}/{cache-folder}/1982110/806/{owner}/208/1.png 

Ex: http://www.google.com.br/getimage/1982110/806/prima/208/1.png 

QUERY STRING PARAMS

@param  $m char, model:requerid  ex: DBR1820
@param  $c char, color:requerid  ex: NR8
@param  $o char, owner:requerid  ex: prima, prima_via, via_porto
@param  $i char, color:requerid  ex: 3FAHP0JAXAR397388 (used vehicles)
@param  $e char, sequence + extension:requerid  ex: 1.jpg (used vehicles)
@param  $img_bg image background ex: 255,255,255
@param  $img_w image size width  ex: 300 auto
@param  $img_h image size height ex: 200 auto
@param  $img_q image qualitity   ex: 90 
 
NEW VEHICLES

Ex: {model}/{color}/{owner}/{width}/{sequence}.{extension}?{query_string}              

@example 345OC31/PW3/prima/500/.jpG

USED VEHICLES

EX: {vehicle_id}/{owner}/{width}/{sequence}.{extension}?{query_string}

@example 3FAHP0JAXAR397388_01/prima/500/1.jpg