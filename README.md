# 🚀 WannaRace
WebApp intentionally made vulnerable to Race Condition

## 🤖 Description
Race Condition vulnerability can be practiced in the developed WebApp. Task is to buy a Mega Box using race condition that costs more than available vouchers. Two challenges are made for practice. Challenge B is to be solved when PHPSESSID cookie is present, cookie is auto created when user is logged in. Happy learning 🎉.

## 🛠 Building and running the Docker image
Build the Docker image with:

```bash
git clone https://github.com/Xib3rR4dAr/WannaRace && cd WannaRace
docker build -t xib3rr4dar/wanna_race:1.0 .
```
Run Docker image:
```
docker run -it --rm xib3rr4dar/wanna_race:1.0
```
OR
```
docker run -it --rm -p 9050:80 xib3rr4dar/wanna_race:1.0
```
Then open in browser relevant IP:PORT

## 🎴 Screenshots
### Challenge #1

Main Page

![image](https://user-images.githubusercontent.com/24238512/146770441-7bda5572-b6db-4127-bd0a-234a1e5b1910.png)

Four vouchers worth 400 units available for recharge

![image](https://user-images.githubusercontent.com/24238512/146770559-0f8548a8-6f38-4511-a071-f36c404fb3f4.png)

Task is to buy Mega box (which is worth 401 units) by exploiting race condition

![image](https://user-images.githubusercontent.com/24238512/146770648-d9bb2bb2-cabc-4766-bc7a-ec86e11ef9ec.png)

### Challenge #2

Same as Challenge #1 but requires login so that PHPSESSID and appropriate cookies are set

![image](https://user-images.githubusercontent.com/24238512/146770999-4bde814c-82da-4d34-83f5-c0d1664f2547.png)

## 💡Solutions

[Challenge #1 Solution](https://github.com/Xib3rR4dAr/WannaRace/blob/master/challenge-1-solution.md)

## 📝 TODOs

✅ Add Solution for Challenge #1  
🕘 Add Solution for Challenge #2
