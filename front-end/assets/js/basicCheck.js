(async () => {
  const t = localStorage.getItem('token_sigma');
  const l = localStorage.getItem('smlvl');

  if (t && l) {
    if (l == 96) window.location.href = './dashboards/atemin/index.html';
    else if (l == 59) window.location.href = './dashboards/penjual/index.html';
    else if (l == 3) window.location.href = './dashboards/pembeli/index.html';
  }
})();
