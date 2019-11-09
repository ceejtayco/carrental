

  var OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "03243a75-a927-4b5c-bcbd-0554406044e0",
       notifyButton: {
        enable: true,
      },
    });
       OneSignal.sendTags({
        userType: 'landlord',
        userId: uid
    });
  });