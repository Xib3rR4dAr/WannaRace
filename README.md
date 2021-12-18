# WannaRace
WebApp intentionally made vulnerable to Race Condition

## Description
Race Condition vulnerability can be practiced in the developed WebApp. Task is to buy a deal using race condition that costs more than available vouchers.

## Building the docker image
Build the docker image with:

```bash
git clone https://github.com/Xib3rR4dAr/WannaRace && cd WannaRace
docker build -t xib3rr4dar/wanna_race:1.0 .
docker run -it --rm xib3rr4dar/wanna_race:1.0
```
