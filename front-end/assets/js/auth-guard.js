// const { json } = require("node:stream/consumers");

(async () => {
  const token = localStorage.getItem('token_sigma');
  const r = localStorage.getItem('smlvl');

  const current = window.location.pathname.split('/');

  let currentpages = window.location.pathname.split('/').pop();
  let currentdir = false;

  console.log(current);

  if (current.includes('dashboards')) {
    const indexDashboard = current.indexOf('dashboards');
    currentdir = current[indexDashboard + 1];
  }

  if (!token || !r) {
    if (currentpages !== 'index.html')
      window.location.href = './../../index.html';
    return;
  }

  //   str = "HAI";
  // //   console.log(str.uppercase())
  //   if(str == 'hai') console.log("hai");
  //   else console.log('em')

  try {
    const responses = await fetch('http://localhost/api/verify-token', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ token: token, r: r }),
    });

    const data = await responses.json();

    if (data.status === 'success') {
      if (currentdir.toUpperCase() === data.data) {
        console.log('success');
        return;
      } else if(currentdir.toUpperCase() !== data.data && currentdir) {
        let path = "./../" + data.data.toLowerCase();
        window.location.href = path;
      }
    } else {
      console.log(data);
    }
  } catch (e) {
    console.log(e);
  }
})();
