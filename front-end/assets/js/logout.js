function logout() {
  localStorage.removeItem('token_sigma');
  localStorage.removeItem('smlvl');
  localStorage.clear();

  alert('logout berhasil!');
  window.location.reload();
}

async function logoutFromAllDevices() {
  const token = localStorage.getItem('token_sigma');
  const l = localStorage.getItem('smlvl');

  try {
    const responses = await fetch('http://localhost/api/logout', {
      method: 'POST',
      headers: { Authorization: `Bearer ${token}`, Accept: 'application/json' },
    });

    const data = await responses.json();

    if (data.status === 'success') {
        alert(data.token)
        console.log(data)
        // logout();
    } else {
      alert('Gagal logout dari server: ' + data);
      console.log(data)
      console.log(data.status)
    }
  } catch (e) {
    console.error('Error pas logout:', e);
    alert('Terjadi kesalahan jaringan. Sesi lokal dipaksa hapus.');
    logout();
  }
}
