
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin WarungKampus - Kelola Laporan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8fafc;
    }
    .admin-gradient {
      background: linear-gradient(135deg, #f0f4ff 0%, #e6f0ff 100%);
    }
    .sidebar {
      background: linear-gradient(180deg, #ffffff 0%, #f5f8ff 100%);
    }
    .nav-button {
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    .nav-button::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 2px;
      background: currentColor;
      transform: scaleX(0);
      transform-origin: right;
      transition: transform 0.3s ease;
    }
    .nav-button:hover::after {
      transform: scaleX(1);
      transform-origin: left;
    }
    .nav-button.active {
      color: #3b82f6;
      font-weight: 500;
    }
    .nav-button.active::after {
      transform: scaleX(1);
    }
    .stat-card {
      transition: all 0.3s ease;
      background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }
    .stat-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    .table-row:hover {
      background-color: #f1f5f9;
    }
    .badge {
      font-size: 0.75rem;
      padding: 0.25rem 0.5rem;
      border-radius: 9999px;
    }
    .badge-pending {
      background-color: #fef3c7;
      color: #92400e;
    }
    .badge-completed {
      background-color: #d1fae5;
      color: #065f46;
    }
    .action-btn {
      transition: all 0.2s ease;
    }
    .action-btn:hover {
      transform: scale(1.1);
    }
    
    /* Foto Modal Styles */
    .foto-modal, .detail-modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.8);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }
    .foto-modal-content, .detail-modal-content {
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      max-width: 90%;
      max-height: 90%;
      overflow: auto;
      position: relative;
    }
    .foto-modal-close, .detail-modal-close {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 24px;
      cursor: pointer;
      color: #333;
    }
    .foto-image {
      max-width: 100%;
      max-height: 80vh;
      display: block;
      margin: 0 auto;
    }
    .foto-info, .detail-info {
      margin-top: 15px;
      text-align: center;
    }
    .view-foto-btn, .view-detail-btn {
      background-color: #3b82f6;
      color: white;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 12px;
      cursor: pointer;
      margin-left: 5px;
      border: none;
    }
    .view-foto-btn:hover, .view-detail-btn:hover {
      background-color: #2563eb;
    }
    .report-detail {
      max-width: 300px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .detail-content {
      max-width: 500px;
      white-space: pre-wrap;
      text-align: left;
      margin-top: 10px;
    }
  </style>
  @include('partials.head')
</head>
<body class="flex h-screen overflow-hidden">
    @include('partials.navbar')
  <!-- Main Content -->
  <div class="flex-1 flex flex-col overflow-hidden ">

   <!-- Main Content Area -->
    <main class="flex-1 overflow-y-auto admin-gradient p-6 mt-20">
      <!-- Reports Table -->
      <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b">
          <h2 class="text-lg font-semibold text-gray-800">Daftar Laporan</h2>
          <div class="flex items-center space-x-2">
          </div>
        </div>
        
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelapor</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detail Laporan</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr class="table-row">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div>
                      <p class="text-sm font-medium">Faisal Masri Maulana</p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">faisal@unja.ac.id</td>
                <td class="px-6 py-4 text-sm text-gray-500">
                  <button class="view-detail-btn" 
                          data-detail="Saya tidak bisa buat akun bingung coyy." 
                          data-name="Faisal Masri Maulana">
                    Lihat Detail
                  </button>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <button class="view-foto-btn" data-foto="report1.jpg" data-name="Faisal Masri Maulana" data-date="10 Jan 2023">
                    Lihat Foto
                  </button>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="badge badge-pending">Belum Selesai</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12 Jan 2023</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <button class="action-btn text-green-600 hover:text-green-900 complete-btn" title="Tandai Selesai">
                    <i class="fas fa-check"></i>
                  </button>
                </td>
              </tr>
              <tr class="table-row">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div>
                      <p class="text-sm font-medium">M. Fauzi Gafar</p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">fauzi@unja.ac.id</td>
                <td class="px-6 py-4 text-sm text-gray-500">
                  <button class="view-detail-btn" 
                          data-detail="Saya tidak bisa buat akun bingung coyy." 
                          data-name="M. Fauzi Gafar">
                    Lihat Detail
                  </button>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <button class="view-foto-btn" data-foto="report2.jpg" data-name="M. Fauzi Gafar" data-date="5 Mar 2023">
                    Lihat Foto
                  </button>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="badge badge-completed">Selesai</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5 Mar 2023</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <button class="action-btn text-gray-400 cursor-not-allowed" title="Sudah Selesai" disabled>
                    <i class="fas fa-check"></i>
                  </button>
                </td>
              </tr>
              <tr class="table-row">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div>
                      <p class="text-sm font-medium">Ivan Goklas</p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">ivan@unja.ac.id</td>
                <td class="px-6 py-4 text-sm text-gray-500">
                  <button class="view-detail-btn" 
                          data-detail="Saya sudah buat akun tapi belum diverifikasi sampai sekarang, gimana ya?." 
                          data-name="Ivan Goklas">
                    Lihat Detail
                  </button>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <button class="view-foto-btn" data-foto="report3.jpg" data-name="Ivan Goklas" data-date="20 Apr 2023">
                    Lihat Foto
                  </button>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="badge badge-pending">Belum Selesai</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20 Apr 2023</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <button class="action-btn text-green-600 hover:text-green-900 complete-btn" title="Tandai Selesai">
                    <i class="fas fa-check"></i>
                  </button>
                </td>
              </tr>
              <tr class="table-row">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div>
                      <p class="text-sm font-medium">Bagas Alif</p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">bagas@unja.ac.id</td>
                <td class="px-6 py-4 text-sm text-gray-500">
                  <button class="view-detail-btn" 
                          data-detail="Saya sudah buat akun tapi belum diverifikasi sampai sekarang, gimana ya?." 
                          data-name="Bagas Alif">
                    Lihat Detail
                  </button>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <button class="view-foto-btn" data-foto="report4.jpg" data-name="Bagas Alif" data-date="15 Feb 2023">
                    Lihat Foto
                  </button>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="badge badge-completed">Selesai</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15 Feb 2023</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <button class="action-btn text-gray-400 cursor-not-allowed" title="Sudah Selesai" disabled>
                    <i class="fas fa-check"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        
        <!-- Pagination -->
        <div class="flex items-center justify-between px-6 py-4 border-t">
          <div class="text-sm text-gray-500">
            Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">4</span> dari <span class="font-medium">24</span> laporan
          </div>
          <div class="flex space-x-2">
            <button class="px-3 py-1 border rounded-lg text-gray-500 hover:bg-gray-100">
              <i class="fas fa-chevron-left"></i>
            </button>
            <button class="px-3 py-1 border rounded-lg bg-blue-600 text-white">1</button>
            <button class="px-3 py-1 border rounded-lg hover:bg-gray-100">2</button>
            <button class="px-3 py-1 border rounded-lg hover:bg-gray-100">3</button>
            <button class="px-3 py-1 border rounded-lg text-gray-500 hover:bg-gray-100">
              <i class="fas fa-chevron-right"></i>
            </button>
          </div>
        </div>
      </div>
    </main>
  </div>

  <!-- Foto Modal -->
  <div id="fotoModal" class="foto-modal">
    <div class="foto-modal-content">
      <span class="foto-modal-close">&times;</span>
      <img id="fotoImage" src="" alt="Foto Laporan" class="foto-image">
      <div class="foto-info">
        <h3 id="fotoUserName"></h3>
        <p id="fotoUploadDate"></p>
      </div>
    </div>
  </div>

  <!-- Detail Modal -->
  <div id="detailModal" class="detail-modal">
    <div class="detail-modal-content">
      <span class="detail-modal-close">&times;</span>
      <div class="detail-info">
        <h3 id="detailUserName" class="text-lg font-semibold"></h3>
        <div class="detail-content" id="detailContent"></div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Complete report buttons
      const completeButtons = document.querySelectorAll('.complete-btn');
      
      completeButtons.forEach(button => {
        button.addEventListener('click', function() {
          if(confirm('Apakah Anda yakin ingin menandai laporan ini sebagai selesai?')) {
            const row = this.closest('tr');
            const statusCell = row.querySelector('td:nth-child(5)');
            statusCell.innerHTML = '<span class="badge badge-completed">Selesai</span>';
            
            // Change action button
            const actionCell = row.querySelector('td:last-child');
            actionCell.innerHTML = `
              <button class="action-btn text-gray-400 cursor-not-allowed" title="Sudah Selesai" disabled>
                <i class="fas fa-check"></i>
              </button>
            `;
            
            alert('Laporan telah ditandai sebagai selesai!');
          }
        });
      });

      // Foto Modal Functionality
      const fotoModal = document.getElementById('fotoModal');
      const fotoModalClose = document.querySelector('.foto-modal-close');
      const fotoImage = document.getElementById('fotoImage');
      const fotoUserName = document.getElementById('fotoUserName');
      const fotoUploadDate = document.getElementById('fotoUploadDate');
      const viewFotoButtons = document.querySelectorAll('.view-foto-btn');

      // Open Foto modal
      viewFotoButtons.forEach(button => {
        button.addEventListener('click', function() {
          const fotoSrc = this.getAttribute('data-foto');
          const userName = this.getAttribute('data-name');
          const uploadDate = this.getAttribute('data-date');
          
          fotoImage.src = fotoSrc;
          fotoImage.alt = `Foto Laporan ${userName}`;
          fotoUserName.textContent = `Laporan dari: ${userName}`;
          fotoUploadDate.textContent = `Diunggah pada: ${uploadDate}`;
          
          fotoModal.style.display = 'flex';
        });
      });

      // Close Foto modal
      fotoModalClose.addEventListener('click', function() {
        fotoModal.style.display = 'none';
      });

      // Detail Modal Functionality
      const detailModal = document.getElementById('detailModal');
      const detailModalClose = document.querySelector('.detail-modal-close');
      const detailUserName = document.getElementById('detailUserName');
      const detailContent = document.getElementById('detailContent');
      const viewDetailButtons = document.querySelectorAll('.view-detail-btn');

      // Open Detail modal
      viewDetailButtons.forEach(button => {
        button.addEventListener('click', function() {
          const detailText = this.getAttribute('data-detail');
          const userName = this.getAttribute('data-name');
          
          detailUserName.textContent = `Laporan dari: ${userName}`;
          detailContent.textContent = detailText;
          
          detailModal.style.display = 'flex';
        });
      });

      // Close Detail modal
      detailModalClose.addEventListener('click', function() {
        detailModal.style.display = 'none';
      });

      // Close when clicking outside modal content
      window.addEventListener('click', function(event) {
        if (event.target === fotoModal) {
          fotoModal.style.display = 'none';
        }
        if (event.target === detailModal) {
          detailModal.style.display = 'none';
        }
      });
    });
  </script>
</body>
</html>