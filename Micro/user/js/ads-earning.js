let currentAdId = null;
  let timerInterval;

  document.addEventListener("DOMContentLoaded", function () {
    disableWatchedAds();
  });

  function getTodayKey(adId) {
    const today = new Date().toISOString().split('T')[0]; // yyyy-mm-dd
    return `watched_${adId}_${today}`;
  }

  function disableWatchedAds() {
    const ads = document.querySelectorAll('.watch-btn');
    ads.forEach(ad => {
      const adId = ad.id.replace('-btn', '');
      const key = getTodayKey(adId);
      if (localStorage.getItem(key)) {
        ad.innerText = "Watched";
        ad.classList.add('disabled-btn');
        ad.disabled = true;
      }
    });
  }

  function watchAd(adId) {
    currentAdId = adId;
    let seconds = 5;
    document.getElementById('timer').innerText = seconds;
    document.getElementById('okBtn').disabled = true;

    const adModal = new bootstrap.Modal(document.getElementById('adModal'));
    adModal.show();

    timerInterval = setInterval(() => {
      seconds--;
      document.getElementById('timer').innerText = seconds;
      if (seconds === 0) {
        clearInterval(timerInterval);
        document.getElementById('okBtn').disabled = false;
      }
    }, 1000);
  }

  function adCompleted() {
    if (currentAdId) {
      const key = getTodayKey(currentAdId);
      localStorage.setItem(key, "watched");

      const btn = document.getElementById(currentAdId + '-btn');
      btn.innerText = "Watched";
      btn.classList.add('disabled-btn');
      btn.disabled = true;

      // Optionally call PHP backend to update balance:
      // fetch(`update-balance.php?ad=${currentAdId}`);
    }
  }