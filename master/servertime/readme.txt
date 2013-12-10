servertime class readme.txt doc file
Peter Klauer, September 7 2003
knito@knito.de

Changes:
October,   26 2003: Optional starting within the body tag per onload="clock()"
                    (see Synchronisation)
October,    3 2003: New Feature $offset_hours. Idea from Martin Link
October,    1 2003: New Language "french" from Eric Mathieu
September, 25 2003: New switch $ucaseampm for uppercase or lowercase am/pm.
                    New Feature: Alarm clock times and output of alarm messages
                    using a user defined php page. 
                    New vars: $alarmon, $alarmdate, $alarm, $onalarm, $alarmpage.
                    Ideas and code contributions from Paul Hargreaves. 
September, 10 2003: New Switches "military" and "showdate" from Paul Hargreaves
September, 11 2003: New Section "Synchronisation" 

Themes covered by this document: 

Functions in the class
Variables in the class
Example
Synchronisation

This class is called "servertime" and shows approximately the time of the server 
from which it had started. If $offset_hours is defined it will display the time
and date plus $offset_hours. Javascript has to be enabled to have the clock work.
The time is shown in a digital text clock which is situated in a <div> tag. The
servers time is not shown in realtime: Until the time is taken over into the
page and the javascript begins to run a cerain time span passes. Afterwards the
clock runs with local speed. Please refer to the last section "Synchronisation".

The feature "alarmtimes" allows the class to announce events for certain days
and times. For example a sports page may announce a match that takes place at
this moment (or in a few moments).

You can test some of the variable settings for servertime on this page:
http://www.ingoknito.de/scripts/servertime/index.php

********************************************************************************
********************************************************************************
Functions in the class servertime:
********************************************************************************
********************************************************************************

InstallClockHead()
InstallClock()
InstallClockBody()
Help()

********************************************************************************
function servertime::InstallClockHead()
********************************************************************************

This function is to be placed into the <head> section of the page. It installes
the array of month names, the initial time value "digital" which is loaded
with the current time from the server and a very common javascript function
named "writeLayer" which does the writing of the clocks content into the page.
I fount this function in so many places that I can not tell you who has it done.

On
http://beta.experts-exchange.com/Web/Web_Languages/JavaScript/Q_20631686.html

you fill find notice of a similar writeLayer function, but I do not have it
from there and can not tell any more where I found it. I worked it over using
Mozilla's Javascript Console until it did not show any more warnings. The clock
will not make any output to the console if correctly installed.

The following class variables cause installclockhead() to do something:

language shorthmonth showdate onalarm alarmon offset_hours

The following class variable is set to true when installclockhead() has run:

ok_head

********************************************************************************
function servertime::InstallClock()
********************************************************************************

This function is to be called in the place where the clock shall be displayed.
It must be placed after installclockhead() and before installclockbody().

The following class variables cause InstallClock() to do something:

divclass divstyle divtag divid title ok_head

The following class variable is set to true when installclockhead() has run:

ok_clock

********************************************************************************
function servertime::InstallClockBody()
********************************************************************************

This function is to be placed near the very end of the page. It installes the
javascript function "clock()" and the first call to this function.
One of the improvements of this class facing the old script is that there is
no need to put a kick starter "onload='clock()'" into the <body> tag.

The following class variables cause installclockbody() to do something:

language military showdate ok_head ok_clock
alarm alarmon onalarm alarmdate ucaseampm

********************************************************************************
function servertime::Help()
********************************************************************************

This is just a little extra function giving a short instruction how to use this
clase in case this readme.txt is lost.

********************************************************************************
********************************************************************************
Variables in the class
********************************************************************************
********************************************************************************

divid        string    Holds the default id name of the clock tag.
                       'Pendule' is the default id name.
divstyle     string    Holds the default style string for the clock tag.
                       'position:absolute;' is default for making NS 4.7 work.
                       I think this is deprecated and could be killed with a ''.
                       As a matter of fact the clock will overwrite the next
                       following line in some browsers if this default value is
                       kept. But I am not yet ready to drop NS 4.7 out of
                       the scope of this class.
divtag       string    Holds the clock's tag "species".
                       'div' is default, other possibility: 'span'.
divclass     string    Holds a classname for the divtag. The class must be 
                       defined in an external style sheet or in a <style>
                       section in the <head> of the page.
                       '' is default: an empty string.
title        string    This is a piece of text which precedes the time sting.
                       'Serverzeit: ' is the default value.
                       You can put anything there. My favorite: an empty string.
language     string    Holds the language for the date format and the month
                       names. 'german' is the default value. Other languages
                       are 'english' and 'french'.
shortmonth   bool      If set to true, the month names will show up only 3 chars
                       long. If set to false, the whole month names will be
                       displayed. False is the default value.
military     bool      If set to true, the time will be displayed in 24h format.
                       If false it will be the 12h format. If the language is not
                       "german" "am" or "pm" will be shown when in 12h standard
                       format. True is the default value.
showdate     bool      If true then day, month and year are shown. No date is
                       shown when false. Default is true.                     
ucaseampm    bool      Uppercase am/pm? Default is TRUE.
alarm        array     Array of time values in military (24h) format, with or
                       without date part. When the date part is included, the
                       format string is "YYYY-MM-DD HH:mm"     
                       
                       The basic format for entries is:
                       
                          $st->alarm['HH:mm'] = 'Message to be shown';
                       
                       Example: 
                       
                       with date part(alarmdate = true)
                       
                          $st->alarm["2003-09-19 01:25"] = "1st+alarm";
                       
                       without date part (alarmdate = false)
                       
                          $st->alarm["01:25"] = "1st+alarm";
                       
alarmdate    bool      Hint for the class, telling if the array "alarm" contains
                       date parts. Default value is FALSE.            
alarmon      bool      The class tries to show the alarms. Default is FALSE.
onalarm      string    Name of a javascript alarm function. Default is the 
                       function of the class "doAlarm", but any other javascript
                       function defined outside of this class can be given. 
alarmpage    string    Name of a page which will output the alarm message and
                       that will be loaded from doAlarm(). Default: "alarm.php".
                       If alarmon is TRUE and onalarm is "doAlarm" then the
                       presence of the page "alarmpage" is checked and the script
                       will be terminated if it is not there. 
alarmpagew   integer   Width of the alarmpage in pixel. Default is 200.
alarmpageh   integer   Height of the alarmpage in pixel. Default is 200.
alarmpageopts string   Additional options. 
                       Default: "scrollbars=yes, resizable=yes"
offset_hours integer   This var changes the hours of the displayed date and time.
                       Set this to any reasonable integer value, positive or 
                       negative. The date part will be changed if necessary. 
                       Default value is 0.
bodyonload   bool      Must be set to true ONLY WHEN the javascript function 
                       clock() was called in the body tag of the page per
                       <body onload="clock()">. Then the calling of clock() per
                       InstallClockBody() is surpressed.
                       
                       Error 1: Clock runs at double speed: Programmer forgot
                       to set this var to true after using 
                       <body onload="clock()">                                                                     
                       
                       Error 2: Clock does not run at all: Programmer forgot to
                       use <body onload="clock()"> after setting this var to true.
                       
                       Default value: False
                       
ok_head      bool      Do not touch it. It is an attempt to make the installation
                       of the class more easy.
ok_clock     bool      Do not touch it. It is an attempt to make the installation
                       of the class more easy.                       
                     
********************************************************************************
********************************************************************************
Example:
********************************************************************************
********************************************************************************
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Test Servertime Klasse</title>
<?php

include 'inc_servertime.php';
$st = new servertime;

$st->InstallClockHead();

?>
</head>
<body>
<?
$st->InstallClock();

$st->InstallClockBody();
?>
</body>
</html>

********************************************************************************
********************************************************************************
Synchronisation:
********************************************************************************
********************************************************************************
At first Servertime gets the time from the server. Then Javascript gets startet 
after the whole web page has loaded. There may be some delay until the clock 
really begins to run. When finally the clock runs, it runs at the speed of the 
computer of the surfer. Mostly the workstations wish to make up the lost time and 
do even better than the server does. They perform up to 5 minutes per hour 
better. To have workstations the right server time it is a good idea, to have 
them refresh the page every some minutes (here it's two minutes) with 

<meta http-equiv="refresh" content="120" />

to synchronize server time and local javascript. The line
<meta http-equiv="refresh" content="120" /> is to be placed into the <head>
section of the page. Please note that if the page reloads there may be a 
jumping effect that may disturb the users pleasure reading your page.
 
To achieve faster starting times until the clock begins to run it is possible to
force the starting of the clock per <body onload="clock()">. Then the class has
to be told about this fact because the clock will run at double speed if not.
Here the example using the <body onload="clock()">:

...
<body onload="clock()">
<?
$st->bodyonload = true;
$st->InstallClock();
...
  