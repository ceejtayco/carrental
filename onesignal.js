var OneSignal = window.OneSignal || [];
OneSignal.push(function() {
  OneSignal.init({
    appId: "c7203da0-332c-4ab4-bf61-9e3802b93cb8",
    autoResubscribe: true,
    notifyButton: {
      enable: true,
    },
    welcomeNotification: {
      "title": "My Custom Title",
      "message": "Thanks for subscribing!",
      // "url": "" /* Leave commented for the notification to not open a window on Chrome and Firefox (on Safari, it opens to your webpage) */
    }
  });
  OneSignal.showNativePrompt();
});