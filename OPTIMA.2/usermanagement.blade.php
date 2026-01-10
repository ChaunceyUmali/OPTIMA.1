<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - {{ config('app.name', 'OPTIMA') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;
        }

        body {
            background: url("{{ asset('backgrounds/testbg.png') }}") center/cover no-repeat;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-animate {
            animation: slideDown 0.3s ease-out;
        }
    </style>
</head>

<body class="m-0 p-0 text-white w-full overflow-x-hidden">

    {{-- Sidebar Component --}}
    @include('partials.sidebar')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if(function_exists('loadSidebar'))
                loadSidebar('usermanagement');
            @endif
        });
    </script>

    {{-- User Management --}}
    <div id="user-management"
        class="bg-cover bg-center min-h-screen flex flex-col justify-start p-[100px_50px] pt-[150px] max-md:p-[60px_30px] max-md:pt-[280px] max-sm:p-[40px_20px] max-sm:pt-[300px]">
        <h1 id="admin" class="text-[48px] mt-0 mb-[30px] text-center max-md:text-4xl max-sm:text-[28px]">User Management
        </h1>

        {{-- Success/Error Messages --}}
        @if (session('success'))
            <div class="bg-green-500/20 border border-green-500 text-green-200 px-4 py-3 rounded-lg mb-4 mx-[10px]">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500/20 border border-red-500 text-red-200 px-4 py-3 rounded-lg mb-4 mx-[10px]">
                {{ session('error') }}
            </div>
        @endif

        <div
            class="flex justify-between items-center mb-5 px-5 max-md:flex-col max-md:gap-[15px] max-md:text-center max-md:px-[10px]">
            <h3 class="text-white text-2xl m-0 max-md:text-xl max-sm:text-lg">List of Users</h3>
            <button
                class="bg-[#27ae60] text-white border-none py-[10px] px-5 rounded-[5px] cursor-pointer text-sm transition-colors duration-300 hover:bg-[#229954] max-md:w-[calc(100%-20px)] max-md:py-3"
                onclick="openAddUserModal()">
                <i class="bi bi-plus-circle"></i> Add User
            </button>
        </div>

        <div class="overflow-x-auto mx-[10px] rounded-lg max-md:mx-0 max-md:rounded-none">
            <table id="userTable" class="w-full border-collapse min-w-[600px]">
                <thead class="bg-[#34495e] text-white">
                    <tr>
                        <th
                            class="p-[15px] text-left font-semibold text-sm uppercase max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-[11px]">
                            ID</th>
                        <th
                            class="p-[15px] text-left font-semibold text-sm uppercase max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-[11px]">
                            Name</th>
                        <th
                            class="p-[15px] text-left font-semibold text-sm uppercase max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-[11px]">
                            Email</th>
                        <th
                            class="p-[15px] text-left font-semibold text-sm uppercase max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-[11px]">
                            Status</th>
                        <th
                            class="p-[15px] text-left font-semibold text-sm uppercase max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-[11px]">
                            Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse($users ?? [] as $user)
                        <tr data-id="{{ $user->id }}" class="bg-white transition-colors duration-200 hover:bg-[#f8f9fa]">
                            <td
                                class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                {{ $user->id }}</td>
                            <td
                                class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                {{ $user->name }}</td>
                            <td
                                class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                {{ $user->email }}</td>
                            <td
                                class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                <span class="inline-block py-[5px] px-3 rounded-[20px] text-xs font-semibold uppercase 
                                    {{ $user->status === 'active' ? 'bg-[#d4edda] text-[#155724]' : 'bg-[#f8d7da] text-[#721c24]' }}">
                                    {{ ucfirst($user->status ?? 'inactive') }}
                                </span>
                            </td>
                            <td
                                class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                <div class="flex gap-2 max-md:gap-[6px] max-sm:gap-1">
                                    <button
                                        class="py-2 px-[15px] border-none rounded cursor-pointer text-[13px] transition-all duration-300 font-medium bg-[#3498db] text-white hover:bg-[#2980b9] max-md:py-2 max-md:px-3 max-md:text-xs max-sm:py-[6px] max-sm:px-[10px] max-sm:text-[11px]"
                                        onclick='editUser(@json($user))'>Edit</button>
                                    <button
                                        class="py-2 px-[15px] border-none rounded cursor-pointer text-[13px] transition-all duration-300 font-medium bg-[#95a5a6] text-white hover:bg-[#7f8c8d] max-md:py-2 max-md:px-3 max-md:text-xs max-sm:py-[6px] max-sm:px-[10px] max-sm:text-[11px]"
                                        onclick="toggleStatus({{ $user->id }})">Status</button>
                                    <button
                                        class="py-2 px-[15px] border-none rounded cursor-pointer text-[13px] transition-all duration-300 font-medium bg-[#e74c3c] text-white hover:bg-[#c0392b] max-md:py-2 max-md:px-3 max-md:text-xs max-sm:py-[6px] max-sm:px-[10px] max-sm:text-[11px]"
                                        onclick="deleteUser({{ $user->id }})">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        {{-- Sample Data --}}
                        <tr data-id="1" class="bg-white transition-colors duration-200 hover:bg-[#f8f9fa]">
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">1</td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">John Doe</td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">john.doe@example.com</td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                <span class="inline-block py-[5px] px-3 rounded-[20px] text-xs font-semibold uppercase bg-[#d4edda] text-[#155724]">Active</span>
                            </td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                <div class="flex gap-2 max-md:gap-[6px] max-sm:gap-1">
                                    <button class="py-2 px-[15px] border-none rounded cursor-pointer text-[13px] transition-all duration-300 font-medium bg-[#3498db] text-white hover:bg-[#2980b9] max-md:py-2 max-md:px-3 max-md:text-xs max-sm:py-[6px] max-sm:px-[10px] max-sm:text-[11px]"
                                        onclick="editUserSample(1)">Edit</button>
                                    <button class="py-2 px-[15px] border-none rounded cursor-pointer text-[13px] transition-all duration-300 font-medium bg-[#95a5a6] text-white hover:bg-[#7f8c8d] max-md:py-2 max-md:px-3 max-md:text-xs max-sm:py-[6px] max-sm:px-[10px] max-sm:text-[11px]"
                                        onclick="toggleStatus(1)">Status</button>
                                    <button class="py-2 px-[15px] border-none rounded cursor-pointer text-[13px] transition-all duration-300 font-medium bg-[#e74c3c] text-white hover:bg-[#c0392b] max-md:py-2 max-md:px-3 max-md:text-xs max-sm:py-[6px] max-sm:px-[10px] max-sm:text-[11px]"
                                        onclick="deleteUser(1)">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr data-id="2" class="bg-white transition-colors duration-200 hover:bg-[#f8f9fa]">
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">2</td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">Jane Smith</td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">jane.smith@example.com</td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                <span class="inline-block py-[5px] px-3 rounded-[20px] text-xs font-semibold uppercase bg-[#f8d7da] text-[#721c24]">Inactive</span>
                            </td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                <div class="flex gap-2 max-md:gap-[6px] max-sm:gap-1">
                                    <button class="py-2 px-[15px] border-none rounded cursor-pointer text-[13px] transition-all duration-300 font-medium bg-[#3498db] text-white hover:bg-[#2980b9] max-md:py-2 max-md:px-3 max-md:text-xs max-sm:py-[6px] max-sm:px-[10px] max-sm:text-[11px]"
                                        onclick="editUserSample(2)">Edit</button>
                                    <button class="py-2 px-[15px] border-none rounded cursor-pointer text-[13px] transition-all duration-300 font-medium bg-[#95a5a6] text-white hover:bg-[#7f8c8d] max-md:py-2 max-md:px-3 max-md:text-xs max-sm:py-[6px] max-sm:px-[10px] max-sm:text-[11px]"
                                        onclick="toggleStatus(2)">Status</button>
                                    <button class="py-2 px-[15px] border-none rounded cursor-pointer text-[13px] transition-all duration-300 font-medium bg-[#e74c3c] text-white hover:bg-[#c0392b] max-md:py-2 max-md:px-3 max-md:text-xs max-sm:py-[6px] max-sm:px-[10px] max-sm:text-[11px]"
                                        onclick="deleteUser(2)">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Add User Modal --}}
    <div id="addUserModal"
        class="hidden fixed z-[2000] left-0 top-0 w-full h-full overflow-auto bg-[rgba(0,0,0,0.6)] backdrop-blur-[5px]">
        <div
            class="modal-animate bg-[#1e293b] my-[5%] mx-auto p-0 rounded-xl w-[90%] max-w-[500px] shadow-[0_10px_40px_rgba(0,0,0,0.5)] max-md:w-[95%] max-sm:w-[96%]">
            <div
                class="bg-gradient-to-br from-[#1abc9c] to-[#16a085] text-white p-[20px_25px] rounded-t-xl flex justify-between items-center max-sm:p-[15px_18px]">
                <h2 id="modalTitle" class="m-0 text-2xl font-semibold max-md:text-xl max-sm:text-lg">Add New User</h2>
                <span
                    class="text-white text-[32px] font-bold cursor-pointer transition-all duration-300 leading-none flex items-center justify-center w-8 h-8 hover:text-[#f1f1f1] hover:rotate-90 max-sm:text-[28px]"
                    onclick="closeModal()">&times;</span>
            </div>
            <form id="userForm" action="{{ route('users.store') }}" method="POST" class="p-[30px_25px] max-md:p-[20px_15px] max-sm:p-[18px_15px]">
                @csrf
                <input type="hidden" name="user_id" id="userId">
                
                <div class="mb-5 max-sm:mb-[15px]">
                    <label for="userName"
                        class="block mb-2 text-[#e2e8f0] font-medium text-sm max-sm:text-[13px]">Name</label>
                    <input type="text" id="userName" name="name" required
                        class="w-full p-[12px_15px] border-2 border-[#334155] rounded-md text-[15px] bg-[#0f172a] text-white transition-all duration-300 focus:outline-none focus:border-[#1abc9c] focus:shadow-[0_0_0_3px_rgba(26,188,156,0.1)] max-sm:p-[11px_12px] max-sm:text-sm">
                </div>
                <div class="mb-5 max-sm:mb-[15px]">
                    <label for="userEmail"
                        class="block mb-2 text-[#e2e8f0] font-medium text-sm max-sm:text-[13px]">Email</label>
                    <input type="email" id="userEmail" name="email" required
                        class="w-full p-[12px_15px] border-2 border-[#334155] rounded-md text-[15px] bg-[#0f172a] text-white transition-all duration-300 focus:outline-none focus:border-[#1abc9c] focus:shadow-[0_0_0_3px_rgba(26,188,156,0.1)] max-sm:p-[11px_12px] max-sm:text-sm">
                </div>
                <div class="mb-5 max-sm:mb-[15px]" id="passwordField">
                    <label for="userPassword"
                        class="block mb-2 text-[#e2e8f0] font-medium text-sm max-sm:text-[13px]">Password</label>
                    <input type="password" id="userPassword" name="password"
                        class="w-full p-[12px_15px] border-2 border-[#334155] rounded-md text-[15px] bg-[#0f172a] text-white transition-all duration-300 focus:outline-none focus:border-[#1abc9c] focus:shadow-[0_0_0_3px_rgba(26,188,156,0.1)] max-sm:p-[11px_12px] max-sm:text-sm">
                    <small class="text-[#94a3b8] text-xs mt-1 block">Leave blank to keep current password when editing</small>
                </div>
                <div class="mb-5 max-sm:mb-[15px]">
                    <label for="userStatus"
                        class="block mb-2 text-[#e2e8f0] font-medium text-sm max-sm:text-[13px]">Status</label>
                    <select id="userStatus" name="status" required
                        class="w-full p-[12px_15px] border-2 border-[#334155] rounded-md text-[15px] bg-[#0f172a] text-white transition-all duration-300 focus:outline-none focus:border-[#1abc9c] focus:shadow-[0_0_0_3px_rgba(26,188,156,0.1)] max-sm:p-[11px_12px] max-sm:text-sm">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="flex gap-3 justify-end mt-[30px] max-md:flex-col">
                    <button type="button"
                        class="bg-[#475569] text-white py-3 px-[30px] border-none rounded-md cursor-pointer text-[15px] font-semibold transition-all duration-300 hover:bg-[#64748b] hover:-translate-y-[2px] max-md:w-full"
                        onclick="closeModal()">Cancel</button>
                    <button type="submit"
                        class="bg-gradient-to-br from-[#1abc9c] to-[#16a085] text-white py-3 px-[30px] border-none rounded-md cursor-pointer text-[15px] font-semibold transition-all duration-300 hover:bg-gradient-to-br hover:from-[#16a085] hover:to-[#1abc9c] hover:-translate-y-[2px] hover:shadow-[0_5px_15px_rgba(26,188,156,0.3)] max-md:w-full">
                        <span id="saveButtonText">Save User</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let editingUserId = null;

        // Sample data for demo
        const sampleUsers = {
            1: { name: 'John Doe', email: 'john.doe@example.com', status: 'active' },
            2: { name: 'Jane Smith', email: 'jane.smith@example.com', status: 'inactive' }
        };

        function openAddUserModal() {
            editingUserId = null;
            document.getElementById('userId').value = '';
            document.getElementById('modalTitle').textContent = 'Add New User';
            document.getElementById('saveButtonText').textContent = 'Save User';
            document.getElementById('userForm').action = '{{ route('users.store') }}';
            document.getElementById('userForm').reset();
            document.getElementById('userPassword').required = true;
            document.getElementById('addUserModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('addUserModal').style.display = 'none';
            document.getElementById('userForm').reset();
            editingUserId = null;
        }

        function editUser(user) {
            editingUserId = user.id;
            document.getElementById('userId').value = user.id;
            document.getElementById('modalTitle').textContent = 'Edit User';
            document.getElementById('saveButtonText').textContent = 'Update User';
            document.getElementById('userName').value = user.name;
            document.getElementById('userEmail').value = user.email;
            document.getElementById('userStatus').value = user.status || 'active';
            document.getElementById('userPassword').required = false;
            document.getElementById('userPassword').value = '';
            
            // Change form action to update route
            document.getElementById('userForm').action = '{{ url('users') }}/' + user.id;
            document.getElementById('addUserModal').style.display = 'block';
        }

        function editUserSample(id) {
            const user = sampleUsers[id];
            if (user) {
                editUser({
                    id: id,
                    name: user.name,
                    email: user.email,
                    status: user.status
                });
            }
        }

        function toggleStatus(id) {
            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ url('users') }}/' + id + '/toggle-status';
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);
            
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PATCH';
            form.appendChild(methodInput);
            
            document.body.appendChild(form);
            form.submit();
        }

        function deleteUser(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                // Create form and submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url('users') }}/' + id;
                
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);
                
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);
                
                document.body.appendChild(form);
                form.submit();
            }
        }

        window.onclick = function (event) {
            const modal = document.getElementById('addUserModal');
            if (event.target === modal) closeModal();
        }
    </script>
</body>

</html>