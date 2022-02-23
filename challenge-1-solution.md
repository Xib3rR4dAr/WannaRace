# Solution for Challenges

## Building and running the Docker image

Thanks for taking out tike time to solve the challenges [Challenge #1](https://github.com/Xib3rR4dAr/WannaRace/blob/master/README.md#challenge-1) and [Challenge #2](https://github.com/Xib3rR4dAr/WannaRace/blob/master/README.md#challenge-2).

🛠 As menioned in [README](https://github.com/Xib3rR4dAr/WannaRace/blob/master/README.md#-building-and-running-the-docker-image), Docker image can be built with:
```bash
git clone https://github.com/Xib3rR4dAr/WannaRace && cd WannaRace
docker build -t xib3rr4dar/wanna_race:1.0 .
```

![Building Docker Image](https://user-images.githubusercontent.com/24238512/155260653-146c3e58-efcf-4b54-a533-8b675dfbde32.png)

🏎️ Built image can be started with:

```bash
docker run -it --rm xib3rr4dar/wanna_race:1.0
# Then visit shown IP in browser
```
OR
```bash
docker run -it --rm -p 9050:80 xib3rr4dar/wanna_race:1.0
# Then visit in browser http://127.0.0.1:9050 OR 
```

![Running Docker Image](https://user-images.githubusercontent.com/24238512/155261255-beebdbcc-4a1f-40e2-8f18-08a22b987e4b.png)

## Installing Turbo Intruder in Burp Suite

Install Turbo Intruder extension from BApp store if not already installed.

To install Turbo Intruder:
Goto Burp Suite >> Extender >> BApp Store >> Search "turbo intruder" and click it >> Install

![Installing Turbo Intruder extension in Burp Suite](https://user-images.githubusercontent.com/24238512/155266682-db4a4202-6cb5-49ba-a38d-89c2bffd4c3d.png)

## Challenge #1

### Task
Buy Mega box in **WebApp A** (which is worth 401 units) by exploiting race condition

### Solution

Configure Burp Suite proxy in browser or use Burp Suite's embedded browser.

![Challenge #1](https://user-images.githubusercontent.com/24238512/155263784-fe59b189-b3d0-40a8-8220-55fb2dcfa5d3.png)

Click **Current Balance** to view current balance and click **Buy Mega Box** to view more required units. Make sure that current balance is **5000** and need  **401** more to buy the mega box else click **Reset DB** to reset database.

![Viewing Balance](https://user-images.githubusercontent.com/24238512/155264855-5af72304-c1a3-4f96-9c73-061e3680b32a.png)

![Trying to buy Mega Box](https://user-images.githubusercontent.com/24238512/155264926-54743fd3-7da3-4b25-b4d3-f329ba43b794.png)

Click **Unused Vouchers** to view available vouchers and copy any of them.

![Listing Unused Vouchers](https://user-images.githubusercontent.com/24238512/155265425-3f385e96-8b7c-4893-aca9-8bbd8b2a422e.png)

Paste any voucher in input box and click **Recharge**.

![Recharging](https://user-images.githubusercontent.com/24238512/155265577-e69290b6-5c48-441a-84ff-ce10c5f7c100.png)

Each voucher is worth **100** units. After first recharge, new balance will be **5100** and **301** more units will be required to buy Mega Box.

![Successfully Recharged Voucher](https://user-images.githubusercontent.com/24238512/155265721-e51e74c8-c407-47d0-94e9-e2a654ca5503.png)

![Again trying to buy Mega Box](https://user-images.githubusercontent.com/24238512/155265869-d7a2c2b5-395f-495f-8c86-e91bd2e62e57.png)

[Install Turbo Intruder](https://github.com/Xib3rR4dAr/WannaRace/new/master#installing-turbo-intruder-in-burp-suite) if not already installed.

Click **Unused Vouchers** again and copy any voucher. Paste unused voucher in input box. Before clicking **Recharge**, enable interception in Burp Suite

![Enabling interception in Burp Suite](https://user-images.githubusercontent.com/24238512/155267347-6dac097f-367a-4517-a945-9bd6bde9721b.png)

While interception is turned on, click "Recharge". Intercepted request will show up in Burp Suite.

Click Action >> Extensions >> Turbo Intruder >> Send to Turbo Intruder.

![Sending intercepted request to Turbo Intruder](https://user-images.githubusercontent.com/24238512/155268117-0ef24658-deb9-41ff-91bd-911e47d86674.png)

Turbo Intruder will now be opened.

Add any sample header and set its value to **%s** ie **Req-No: %s**.

From select dropdown, click examples/race.py or paste code from [burp-suite-turbo-intruder-race.py](https://gist.github.com/Xib3rR4dAr/4bbd6b06cb59efd1a75aa433df22f1f2).

Change **concurrentConnections** and _iterations_ to any suitable value like 3 or 5 or 10 etc. With different vouchers, play with different values until more than 100 units are earned. I've set number of concurrent connections to **10**.

After changing configuration, click **Attack**.

![Racing with Turbo Intruder](https://user-images.githubusercontent.com/24238512/155269756-12803357-127c-4f62-8bb9-0507229ab1c2.png)

After trying race condition on the endpoint, our units will be increased depending on the success of race condition.

In my case, befores testing race condition balance was **5100**  and after testing new balance got **5400** instead of going to **5200**.

![Successfuly exploited race condition](https://user-images.githubusercontent.com/24238512/155270300-e8136742-945e-4990-976d-223d7f16f855.png)

By exploiting race condition, in my case it was possible to get **300** units instead of **100**.

![Increased Balance](https://user-images.githubusercontent.com/24238512/155271001-39b3efa1-ead5-4cb4-ab26-be569c9520ff.png)

Try race condition again with any other unused voucher. Click Halt >> Configure to again open Turbo Intruder racing interface.

![Changing voucher number and attacking again](https://user-images.githubusercontent.com/24238512/155271376-e971dc0a-138d-4aa5-b8ba-8beb3d64dff3.png)

Depending on number of successful race conditoins, this time some requests gave a successfull recharge while some gave error that card doesn't exist.

**Successful recharge:**

![Successful recharge](https://user-images.githubusercontent.com/24238512/155271602-6284e01c-132a-4157-8cb5-8c2bcb022004.png)

**Unsuccessful recharge:**

![Unsuccessfulrecharge](https://user-images.githubusercontent.com/24238512/155271896-dde39548-4a52-4e59-a747-467b153ea60a.png)

This time balance changed to **5700** units instead of going to **5400** which is now enough to buy Mega Box.

![Enough Balance to buy Mega Box](https://user-images.githubusercontent.com/24238512/155272526-85cde0e8-435a-4637-8a10-a798b1a6f1d0.png)

🎉 Tadaaaa! Mega Box bought successfully after exploiting race condition to get more balance.

![Flag #1 ~ Bought Mega Box](https://user-images.githubusercontent.com/24238512/155272892-9e04eca5-7a11-4d40-bd10-253ed3d0a0e4.png)


