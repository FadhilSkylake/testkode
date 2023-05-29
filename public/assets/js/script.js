document.getElementById("form").addEventListener("submit", function (event) {
  var namaKlub = document.getElementById("nama_klub");
  var kotaKlub = document.getElementById("kotaklub");

  if (!namaKlub.value || !kotaKlub.value) {
    event.preventDefault(); // Mencegah pengiriman form

    var feedback = document.getElementById("feedback");
    feedback.classList.remove("hidden"); // Menghapus kelas 'hidden' untuk menampilkan feedback
  }
});
