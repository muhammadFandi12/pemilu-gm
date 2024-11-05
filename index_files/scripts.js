function showCandidates() {
    document.getElementById('login').style.display = 'none';
    document.getElementById('confirmVote').style.display = 'none';
    document.getElementById('candidates').style.display = 'block';
  }
  
  function confirmVote(candidate) {
    document.getElementById('candidates').style.display = 'none';
    document.getElementById('confirmationMessage').textContent = `Apakah Anda yakin memilih ${candidate}?`;
    document.getElementById('confirmVote').style.display = 'block';
  }
  
  function submitVote() {
    alert("Terima kasih, suara Anda telah disimpan!");
    // Logic pengiriman suara akan disini
    document.getElementById('login').style.display = 'block';
    document.getElementById('confirmVote').style.display = 'none';
    document.getElementById('candidates').style.display = 'none';
  }
  