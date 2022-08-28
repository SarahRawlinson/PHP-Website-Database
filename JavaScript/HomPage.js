console.log("Home Page JS running")
class Time
{
    constructor(name, startTime, endTime, detail)
    {
        this.name = name;
        this.startTime = startTime;
        this.endTime = endTime;
        this.detail = detail;

    }
    compare(object)
    {
        if (this.startTime.getHours() < this.endTime.getHours())
        {
            return object.getHours() > this.startTime.getHours() && object.getHours() < this.endTime.getHours();
        }
        else
        {
            let newEnd = new Date();
            newEnd.setHours(23,59,59);
            let newStart = new Date();
            newStart.setHours(0);
            return (object.getHours() > this.startTime.getHours() && object.getHours() < newEnd.getHours())
                || (object.getHours() > newStart.getHours() && object.getHours() < this.endTime.getHours());
        }

    }
}

// enum days
// {
//     monday,
//     tuesday,
//     wednesday,
//     thursday,
//     friday,
//     saturday,
//     sunday
// }
//[days.monday, days.tuesday, days.wednesday, days.thursday, days.friday]

// this is very messy, could probably be cleaned up once I learn more JavaScript

let wakeUp = new Date();
wakeUp.setHours(7,30);
let endWakeUp = new Date();
endWakeUp.setHours(8,30);
let wakeUpTime = new Time("Wake Up", wakeUp, endWakeUp,"")

let startWork = new Date();
startWork.setHours(8,30);
let endStartWork = new Date();
endStartWork.setHours(12.30,30);
let startedWork = new Time("At Work", startWork, endStartWork,"")

let lunch = new Date();
lunch.setHours(12,30);
let endLunch = new Date();
endLunch.setHours(13,0);
let onLunch = new Time("On Lunch", lunch, endLunch,"")


let backToWork = new Date();
backToWork.setHours(13,0);
let finishWork = new Date();
finishWork.setHours(16,30);
let backToWorkAgain = new Time("At Work", backToWork, finishWork,"")

let programming = new Date();
programming.setHours(17,0);
let endProgramming = new Date();
endProgramming.setHours(20,0);
let startProgramming = new Time("Coding", programming, endProgramming,"")

let watchingTV = new Date();
watchingTV.setHours(22,0);
let gaming = new Date();
gaming.setHours(20,0);
let startGaming = new Time("Gaming", gaming, watchingTV,"")

let asleep = new Date();
asleep.setHours(0,0);

let startWatchingTV = new Time("Watching TV", watchingTV, asleep,"")



let inBed = new Time("In Bed", asleep, wakeUp,"")


let i = 0;
let count = 0;
times = [wakeUpTime, startedWork, onLunch, backToWorkAgain, startProgramming, startGaming, startWatchingTV, inBed];
let match = false;

function GetData()
{

    while (!match && count < times.length * 2)
    {
        count++;
        i++;
        i=i>times.length-1?0:i;
        match = times[i].compare(new Date());
        console.log("checking " + times[i].name)
        if (match)
        {
            console.log(times[i].name)
            return "Right now I am Most Likely: " + times[i].name;
        }
    }
}
GetData();
//document.getElementById("WhatImDoing").innerHTML = GetData();