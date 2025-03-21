document.addEventListener("DOMContentLoaded", function () {
    const btnLihatGrafik = document.getElementById("btnLihatGrafik");
    const btnTutupGrafik = document.getElementById("btnTutupGrafik");
    const chartContainer = document.getElementById("chartContainer");
    let chartInstance = null; // Simpan objek Chart.js

    btnLihatGrafik.addEventListener("click", function () {
        chartContainer.style.display = "block";
        btnLihatGrafik.style.display = "none";

        // Fetch data dan tampilkan chart
        fetch("chartdokter.php")
            .then(response => response.json())
            .then(data => {
                let namaDokter = data.map(d => d.nama);
                let ratingDokter = data.map(d => d.rating);

                let ctx = document.getElementById("chartDokter").getContext("2d");

                // Jika grafik sebelumnya ada, hapus dulu biar nggak dobel
                if (chartInstance) {
                    chartInstance.destroy();
                }

                chartInstance = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: namaDokter,
                        datasets: [{
                            label: "Rating Dokter",
                            data: ratingDokter,
                            backgroundColor: [
                                "rgba(255, 99, 132, 0.5)", 
                                "rgba(54, 162, 235, 0.5)", 
                                "rgba(255, 206, 86, 0.5)"
                            ],
                            borderColor: [
                                "rgba(255, 99, 132, 1)", 
                                "rgba(54, 162, 235, 1)", 
                                "rgba(255, 206, 86, 1)"
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                min: 0,
                                max: 5,
                                ticks: { stepSize: 1 }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error("Error fetching data:", error));
    });

    // Event untuk tombol Tutup Grafik
    btnTutupGrafik.addEventListener("click", function () {
        chartContainer.style.display = "none";
        btnLihatGrafik.style.display = "block";

        // Hapus grafik jika ada, supaya nggak numpuk saat dibuka lagi
        if (chartInstance) {
            chartInstance.destroy();
            chartInstance = null;
        }
    });
});