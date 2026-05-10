<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-black text-gray-800 leading-tight">Master Control - Manajemen Akun</h2>
                <p class="text-xs text-gray-400 font-medium uppercase mt-1 tracking-wider">Kelola akses dan wewenang staff pada sistem</p>
            </div>
        </div>
    </x-slot>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-8">
        <div class="px-8 py-6 border-b border-gray-50 bg-gray-50/30 flex items-center gap-3">
            <div class="p-2 bg-blue-50 text-blue-600 rounded-xl border border-blue-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
            <h3 class="font-black text-gray-800 uppercase text-[10px] tracking-[0.2em]">Daftarkan Staff Baru</h3>
        </div>
        
        <div class="p-8">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50/50 focus:border-blue-500 focus:ring-0 text-sm font-bold text-gray-700 transition" 
                               placeholder="Contoh: Budi Santoso">
                        @error('name') <span class="text-xs text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50/50 focus:border-blue-500 focus:ring-0 text-sm font-bold text-gray-700 transition" 
                               placeholder="staff@nusantaramotor.com">
                        @error('email') <span class="text-xs text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">Hak Akses (Role)</label>
                        <select name="role" required class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50/50 focus:border-blue-500 focus:ring-0 text-sm font-bold text-gray-700 transition appearance-none">
                            <option value="kasir">Staff Kasir / Operasional</option>
                            <option value="admin">Administrator (Akses Penuh)</option>
                        </select>
                        @error('role') <span class="text-xs text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">Password</label>
                        <input type="password" name="password" required
                               class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50/50 focus:border-blue-500 focus:ring-0 text-sm font-bold text-gray-700 transition" 
                               placeholder="Minimal 8 karakter">
                        @error('password') <span class="text-xs text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                               class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50/50 focus:border-blue-500 focus:ring-0 text-sm font-bold text-gray-700 transition" 
                               placeholder="Ketik ulang password">
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-gray-900 hover:bg-black text-white font-black py-3.5 px-6 rounded-xl shadow-lg shadow-gray-200 transition transform active:scale-95 uppercase text-[10px] tracking-widest flex justify-center items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                            Simpan Akun Baru
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-50 bg-white flex justify-between items-center">
            <h3 class="font-black text-gray-800 uppercase text-[10px] tracking-[0.2em]">Daftar Pengguna Aktif</h3>
            <span class="text-[9px] font-black px-3 py-1 bg-green-50 text-green-600 rounded-full uppercase tracking-widest border border-green-100/50">Live System</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">Profile Karyawan</th>
                        <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">Email Terdaftar</th>
                        <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">Hak Akses</th>
                        <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest text-center">Aksi Manajemen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50/30 transition group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-black text-xs uppercase shadow-inner {{ $user->role == 'admin' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-500 border border-gray-200' }}">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <span class="font-black text-gray-800 text-sm capitalize">{{ $user->name }}</span>
                                </div>
                            </td>
                            
                            <td class="px-8 py-5 text-sm font-bold text-gray-500">{{ $user->email }}</td>
                            
                            <td class="px-8 py-5">
                                <span class="px-3 py-1.5 text-[9px] font-black uppercase tracking-[0.1em] rounded-md border shadow-sm {{ $user->role == 'admin' ? 'bg-blue-50 text-blue-600 border-blue-100/50' : 'bg-green-50 text-green-600 border-green-100/50' }}">
                                    {{ $user->role == 'admin' ? 'Administrator' : 'Staff Kasir' }}
                                </span>
                            </td>
                            
                            <td class="px-8 py-5 text-center">
                                @if($user->id !== Auth::id())
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Cabut akses untuk karyawan ini? Akun akan dihapus permanen.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2.5 bg-red-50 text-red-500 rounded-xl hover:bg-red-600 hover:text-white transition duration-200 mx-auto flex shadow-sm border border-red-100" title="Hapus Akun">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-[9px] font-black text-gray-300 uppercase tracking-widest px-3 py-1 bg-gray-50 rounded border border-gray-100 cursor-not-allowed">
                                        Akun Anda
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-16 text-center">
                                <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Belum ada akun terdaftar.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>