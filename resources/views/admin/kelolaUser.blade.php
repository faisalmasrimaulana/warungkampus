@extends('layouts.app')
@section('content')

  <style>
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
    .badge-active {
      background-color: #d1fae5;
      color: #065f46;
    }
    .badge-rejected {
      background-color: #fee2e2;
      color: #991b1b;
    }
    .badge-banned {
      background-color: #f3e8ff;
      color: #6b21a8;
    }
    .action-btn {
      transition: all 0.2s ease;
    }
    .action-btn:hover {
      transform: scale(1.1);
    }
    
    /* KTM Modal Styles */
    .ktm-modal {
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
    .ktm-modal-content {
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      max-width: 90%;
      max-height: 90%;
      overflow: auto;
      position: relative;
    }
    .ktm-modal-close {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 24px;
      cursor: pointer;
      color: #333;
    }
    .ktm-image {
      max-width: 100%;
      max-height: 80vh;
      display: block;
      margin: 0 auto;
    }
    .ktm-info {
      margin-top: 15px;
      text-align: center;
    }
    .view-ktm-btn {
      background-color: #3b82f6;
      color: white;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 12px;
      cursor: pointer;
      margin-left: 5px;
      border: none;
    }
    .view-ktm-btn:hover {
      background-color: #2563eb;
    }
  </style>

    <!-- KTM Modal -->
    <div id="ktmModal" class="ktm-modal">
      <div class="ktm-modal-content">
        <span class="ktm-modal-close">&times;</span>
        <img id="ktmImage" src="" alt="KTM" class="w-120 h-auto">
        <div class="ktm-info">
          <h3 id="ktmUserName"></h3>
          <p id="ktmUserEmail"></p>
          <p id="ktmUploadDate"></p>
        </div>
      </div>
    </div>

   <!-- Main Content Area -->
    <main class="flex-1 overflow-y-auto admin-gradient p-6 mt-20">
      <!-- Filter and Search -->
      <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
          <div class="w-full md:w-1/3">
            <input type="text" placeholder="Cari user..." class="search-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div class="flex flex-col sm:flex-row gap-3">
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
              <option value="">Semua Status</option>
              <option value="active">Aktif</option>
              <option value="pending">Menunggu</option>
              <option value="banned">Diblokir</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Users Table -->
      <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b">
          <h2 class="text-lg font-semibold text-gray-800">Daftar User</h2>
          <div class="flex items-center space-x-2">
          </div>
        </div>
        
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">KTM</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bergabung</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users->SortByDesc('created_at')->take(10) as $user )
                <tr class="table-row">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <img class="w-10 h-10 rounded-full mr-4" src="{{ $user->foto_profil != 'fotoprofil.jpg' ? asset('storage/' . $user->foto_profil) : asset('assets/fotoprofil.jpg')}}" alt="User">
                      <div>
                        <p class="text-sm font-medium">{{$user->nama}}</p>
                        <p class="text-xs text-gray-500">{{$user->email}}</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$user->email}}</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <button class="view-ktm-btn" data-name="{{$user->nama}}" data-email="{{$user->email}}" data-date="{{$user->created_at}}">
                      Lihat KTM
                    </button>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    @if($user->is_verified)
                    <span class="badge badge-active">Terverifikasi</span>
                    @else
                    <span class="badge badge-pending">Menunggu</span>
                    @endif
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$user->created_at->format('d M Y')}}</td>

                  @if(!$user->is_verified)
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <form action="{{ route('admin.user.verifikasi', $user->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                        <button class="action-btn text-green-600 hover:text-green-900 mr-2 hover:cursor-pointer" type="submit" title="Setujui">
                        <i class="fas fa-check"></i>
                        </button>
                    </form>
                    <form action="{{ route('admin.user.hapus', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="action-btn text-red-600 hover:text-red-900 hover:cursor-pointer" type="submit" title="Tolak">
                        <i class="fas fa-times"></i></button>
                    </form>
                  </td>
                  @else
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class="action-btn text-blue-600 hover:text-blue-900 mr-3" title="Detail">
                      <i class="fas fa-eye"></i>
                    </button>
                    <button class="action-btn text-yellow-600 hover:text-red-900 mr-3" title="Blokir">
                      <i class="fas fa-ban"></i>
                    </button>
                    <button class="action-btn text-red-600 hover:text-red-900" title="Blokir">
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                  @endif
                </tr>
                @endforeach
              <!-- <tr class="table-row">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <img class="w-10 h-10 rounded-full mr-4" src="user3.jpg" alt="User">
                    <div>
                      <p class="text-sm font-medium">Ivan Goklas</p>
                      <p class="text-xs text-gray-500">@ivanee</p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">ivan@unja.ac.id</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <button class="view-ktm-btn" data-ktm="ktm3.jpg" data-name="Ivan Goklas" data-email="ivan@unja.ac.id" data-date="20 Apr 2023">
                    Lihat KTM
                  </button>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="badge badge-pending">Menunggu</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20 Apr 2023</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <button class="action-btn text-blue-600 hover:text-blue-900 mr-3" title="Detail">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="action-btn text-green-600 hover:text-green-900 mr-3" title="Setujui">
                    <i class="fas fa-check"></i>
                  </button>
                  <button class="action-btn text-red-600 hover:text-red-900" title="Tolak">
                    <i class="fas fa-times"></i>
                  </button>
                </td>
              </tr>
              <tr class="table-row">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <img class="w-10 h-10 rounded-full mr-4" src="user4.jpg" alt="User">
                    <div>
                      <p class="text-sm font-medium">Bagas Alif</p>
                      <p class="text-xs text-gray-500">@bagas</p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">bagas@unja.ac.id</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <button class="view-ktm-btn" data-ktm="ktm4.jpg" data-name="Bagas Alif" data-email="bagas@unja.ac.id" data-date="15 Feb 2023">
                    Lihat KTM
                  </button>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="badge badge-banned">Diblokir</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15 Feb 2023</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <button class="action-btn text-blue-600 hover:text-blue-900 mr-3" title="Detail">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="action-btn text-green-600 hover:text-green-900" title="Aktifkan">
                    <i class="fas fa-unlock"></i>
                  </button>
                </td>
              </tr> -->
            </tbody>
          </table>
        </div>
        
        <!-- Pagination -->
        <div class="flex items-center justify-between px-6 py-4 border-t">
          <div class="text-sm text-gray-500">
            Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">4</span> dari <span class="font-medium">124</span> user
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
  <script>
    // KTM View Functionality
      const ktmModal = document.getElementById('ktmModal');
      const ktmModalClose = document.querySelector('.ktm-modal-close');
      const ktmImage = document.getElementById('ktmImage');
      const ktmUserName = document.getElementById('ktmUserName');
      const ktmUserEmail = document.getElementById('ktmUserEmail');
      const ktmUploadDate = document.getElementById('ktmUploadDate');
      const viewKtmButtons = document.querySelectorAll('.view-ktm-btn');

      // Open KTM modal
      document.querySelectorAll('.view-ktm-btn').forEach(button => {
        button.addEventListener('click', () => {
            const ktmSrc = button.getAttribute('data-ktm');
            const name = button.getAttribute('data-name');
            const email = button.getAttribute('data-email');
            const date = button.getAttribute('data-date');

            // Set src gambar di modal, pakai asset kalau di Laravel
            document.getElementById('ktmImage').src = "{{ asset('storage/' . $user->ktm) }}";

            // Set info user di modal
            document.getElementById('ktmUserName').textContent = name;
            document.getElementById('ktmUserEmail').textContent = email;
            document.getElementById('ktmUploadDate').textContent = date;

            // Tampilkan modal
            document.getElementById('ktmModal').style.display = 'flex';
        })});

        // Untuk tombol close modal
        document.querySelector('.ktm-modal-close').addEventListener('click', () => {
        document.getElementById('ktmModal').style.display = 'none';
        });


      // Close KTM modal
      ktmModalClose.addEventListener('click', function() {
        ktmModal.style.display = 'none';
      });

      // Close when clicking outside modal content
      window.addEventListener('click', function(event) {
        if (event.target === ktmModal) {
          ktmModal.style.display = 'none';
        }
      });
  </script>
@endsection