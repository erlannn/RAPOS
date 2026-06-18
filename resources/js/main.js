// Dummy data (bisa di-overwrite dari controller)
    const salesPerHourData = [12, 19, 3, 5, 2, 3, 9, 15, 20, 25, 18, 10];
    const salesPerCategoryData = [300, 150, 200, 100];
    const salesPerCashierData = [120, 90, 150, 80];
    const topProductsData = [50, 45, 40, 38, 35, 30, 28, 25, 22, 20];
    const leastProductsData = [5, 7, 8, 10, 12, 15, 18, 20, 22, 25];

    // Penjualan Per Jam
    new Chart(document.getElementById('salesPerHourChart'), {
        type: 'line',
        data: {
            labels: ['08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00'],
            datasets: [{
                label: 'Penjualan per Jam',
                data: salesPerHourData,
                borderColor: '#f43f5e',
                backgroundColor: '#fda4af',
                fill: true,
                tension: 0.3
            }]
        }
    });

    // Penjualan Per Kategori
    new Chart(document.getElementById('salesPerCategoryChart'), {
        type: 'doughnut',
        data: {
            labels: ['Makanan', 'Minuman', 'Snack', 'Lainnya'],
            datasets: [{
                data: salesPerCategoryData,
                backgroundColor: ['#38bdf8','#22d3ee','#34d399','#facc15']
            }]
        }
    });

    // Penjualan Per Kasir
    new Chart(document.getElementById('salesPerCashierChart'), {
        type: 'bar',
        data: {
            labels: ['Kasir A','Kasir B','Kasir C','Kasir D'],
            datasets: [{
                label: 'Penjualan per Kasir',
                data: salesPerCashierData,
                backgroundColor: ['#6366f1','#ec4899','#10b981','#f97316']
            }]
        }
    });

    // Top 10 Produk Paling Laku
    new Chart(document.getElementById('topProductsChart'), {
        type: 'bar',
        data: {
            labels: ['Produk 1','Produk 2','Produk 3','Produk 4','Produk 5','Produk 6','Produk 7','Produk 8','Produk 9','Produk 10'],
            datasets: [{
                label: 'Jumlah Terjual',
                data: topProductsData,
                backgroundColor: '#22c55e'
            }]
        }
    });

    // Top 10 Produk Kurang Laku
    new Chart(document.getElementById('leastProductsChart'), {
        type: 'bar',
        data: {
            labels: ['Produk A','Produk B','Produk C','Produk D','Produk E','Produk F','Produk G','Produk H','Produk I','Produk J'],
            datasets: [{
                label: 'Jumlah Terjual',
                data: leastProductsData,
                backgroundColor: '#f59e0b'
            }]
        }
    });