<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Monitoring - {{ config('app.name', 'OPTIMA') }}</title>
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
                loadSidebar('tasks', 'project-manager');
            @endif
        });   
    </script>

    {{-- Task Monitoring --}}
    <div id="task-page"
        class="bg-cover bg-center min-h-screen flex flex-col justify-start p-[100px_50px] pt-[150px] max-md:p-[60px_30px] max-md:pt-[280px] max-sm:p-[40px_20px] max-sm:pt-[300px]">
        <h1 id="admin" class="text-[48px] mt-0 mb-10 text-center max-md:text-4xl max-sm:text-[28px]">Task Monitoring
        </h1>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-500/20 border border-green-500 text-green-200 px-4 py-3 rounded-lg mb-4 mx-[10px]">
                {{ session('success') }}
            </div>
        @endif

        <div
            class="flex justify-between items-center mb-5 px-5 max-md:flex-col max-md:gap-[15px] max-md:text-center max-md:px-[10px]">
            <h3 class="text-white text-2xl m-0 max-md:text-xl max-sm:text-lg">List of All Tasks</h3>
            <button
                class="no-underline bg-[#27ae60] text-white border-none py-[10px] px-5 rounded-[5px] cursor-pointer text-sm transition-colors duration-300 hover:bg-[#229954] max-md:w-[calc(100%-20px)] max-md:mx-[10px] max-md:py-3 max-sm:w-[calc(100%-20px)] max-sm:py-3 max-sm:px-[15px]"
                onclick="openCreateTaskModal()">
                <i class="bi bi-plus-circle"></i> Create Task
            </button>
        </div>

        <div class="overflow-x-auto mx-[10px] rounded-lg max-md:mx-0 max-md:rounded-none">
            <table id="tasksTable" class="w-full border-collapse min-w-[600px]">
                <thead class="bg-[#34495e] text-white">
                    <tr>
                        <th
                            class="p-[15px] text-left font-semibold text-sm uppercase max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-[11px]">
                            ID</th>
                        <th
                            class="p-[15px] text-left font-semibold text-sm uppercase max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-[11px]">
                            Task Title</th>
                        <th
                            class="p-[15px] text-left font-semibold text-sm uppercase max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-[11px]">
                            Assigned To</th>
                        <th
                            class="p-[15px] text-left font-semibold text-sm uppercase max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-[11px]">
                            Due Date</th>
                        <th
                            class="p-[15px] text-left font-semibold text-sm uppercase max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-[11px]">
                            Status</th>
                        <th
                            class="p-[15px] text-left font-semibold text-sm uppercase max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-[11px]">
                            Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse($tasks ?? [] as $task)
                        <tr data-id="{{ $task->id }}" class="bg-white transition-colors duration-200 hover:bg-[#f8f9fa]">
                            <td
                                class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                {{ $task->id }}</td>
                            <td
                                class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                {{ $task->title }}</td>
                            <td
                                class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                {{ $task->assignedUser->name ?? 'Unassigned' }}</td>
                            <td
                                class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                {{ $task->due_date ? $task->due_date->format('Y-m-d') : 'N/A' }}</td>
                            <td
                                class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                <span class="inline-block py-[5px] px-3 rounded-[20px] text-xs font-semibold uppercase 
                                    {{ in_array($task->status, ['Completed', 'In Progress']) ? 'bg-[#d4edda] text-[#155724]' : 'bg-[#f8d7da] text-[#721c24]' }}">
                                    {{ $task->status }}
                                </span>
                            </td>
                            <td
                                class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                <div class="flex gap-2 max-md:gap-[6px] max-sm:gap-1">
                                    <button
                                        class="py-2 px-[15px] border-none rounded cursor-pointer text-[13px] transition-all duration-300 font-medium bg-[#3498db] text-white hover:bg-[#2980b9] max-md:py-2 max-md:px-3 max-md:text-xs max-sm:py-[6px] max-sm:px-[10px] max-sm:text-[11px] whitespace-nowrap"
                                        onclick='editTask(@json($task))'>Edit Task</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        {{-- Sample Data --}}
                        <tr data-id="101" class="bg-white transition-colors duration-200 hover:bg-[#f8f9fa]">
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">101</td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">Homepage Redesign</td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">John Doe</td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">2026-01-20</td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                <span class="inline-block py-[5px] px-3 rounded-[20px] text-xs font-semibold uppercase bg-[#d4edda] text-[#155724]">In Progress</span>
                            </td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                <div class="flex gap-2 max-md:gap-[6px] max-sm:gap-1">
                                    <button class="py-2 px-[15px] border-none rounded cursor-pointer text-[13px] transition-all duration-300 font-medium bg-[#3498db] text-white hover:bg-[#2980b9] max-md:py-2 max-md:px-3 max-md:text-xs max-sm:py-[6px] max-sm:px-[10px] max-sm:text-[11px] whitespace-nowrap"
                                        onclick="editTaskSample(101)">Edit Task</button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Task Modal (Create/Edit) --}}
    <div id="taskModal"
        class="hidden fixed z-[2000] left-0 top-0 w-full h-full overflow-auto bg-[rgba(0,0,0,0.6)] backdrop-blur-[5px]">
        <div
            class="modal-animate bg-white my-[3%] mx-auto p-0 rounded-2xl w-[90%] max-w-[800px] shadow-[0_10px_40px_rgba(0,0,0,0.5)] max-md:w-[95%] max-sm:w-[96%]">
            <div
                class="bg-gradient-to-br from-[#1abc9c] to-[#16a085] text-white p-[20px_25px] rounded-t-2xl flex justify-between items-center max-sm:p-[15px_18px]">
                <h2 id="modalTitle" class="m-0 text-2xl font-semibold max-md:text-xl max-sm:text-lg">Create New Task
                </h2>
                <span
                    class="text-white text-[32px] font-bold cursor-pointer transition-all duration-300 leading-none flex items-center justify-center w-8 h-8 hover:text-[#f1f1f1] hover:rotate-90 max-sm:text-[28px]"
                    onclick="closeTaskModal()">&times;</span>
            </div>
            <div class="p-[30px_25px] max-md:p-[20px_15px] max-sm:p-[18px_15px]">
                <form id="taskForm" action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="task_id" id="taskId">
                    
                    <div class="mb-7 text-center text-[#333]">
                        <p class="text-[#666] text-base" id="modalDescription">Fill in the details below to assign a new
                            task.</p>
                    </div>

                    <div class="mb-5">
                        <label for="taskTitle" class="block mb-2 text-[#333] font-medium text-sm">Task Title</label>
                        <input type="text" id="taskTitle" name="title" required
                            class="w-full py-3 px-4 border-2 border-[#e2e8f0] rounded-md text-[15px] text-[#333] bg-white focus:outline-none focus:border-[#1abc9c] focus:shadow-[0_0_0_3px_rgba(26,188,156,0.1)]">
                    </div>

                    <div class="mb-5">
                        <label for="taskDesc" class="block mb-2 text-[#333] font-medium text-sm">Description</label>
                        <textarea id="taskDesc" name="description" required
                            class="w-full py-3 px-4 border-2 border-[#e2e8f0] rounded-md text-[15px] resize-y min-h-[100px] text-[#333] font-[inherit] bg-white focus:outline-none focus:border-[#1abc9c]"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-5 md:grid-cols-1 md:gap-4">
                        <div class="mb-5">
                            <label for="dueDate" class="block mb-2 text-[#333] font-medium text-sm">Due Date</label>
                            <input type="date" id="dueDate" name="due_date" required
                                class="w-full py-3 px-4 border-2 border-[#e2e8f0] rounded-md text-[15px] text-[#333] bg-white focus:outline-none focus:border-[#1abc9c] focus:shadow-[0_0_0_3px_rgba(26,188,156,0.1)]">
                        </div>
                        <div class="mb-5">
                            <label for="assignMember" class="block mb-2 text-[#333] font-medium text-sm">Assign
                                Member</label>
                            <select id="assignMember" name="assigned_to" required
                                class="w-full py-3 px-4 border-2 border-[#e2e8f0] rounded-md text-[15px] text-[#333] bg-white focus:outline-none focus:border-[#1abc9c] focus:shadow-[0_0_0_3px_rgba(26,188,156,0.1)]">
                                <option value="">Select Member...</option>
                                @foreach($teamMembers ?? [] as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="taskStatus" class="block mb-2 text-[#333] font-medium text-sm">Status</label>
                        <select id="taskStatus" name="status" required
                            class="w-full py-3 px-4 border-2 border-[#e2e8f0] rounded-md text-[15px] text-[#333] bg-white focus:outline-none focus:border-[#1abc9c] focus:shadow-[0_0_0_3px_rgba(26,188,156,0.1)]">
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>

                    <div class="mt-7 flex justify-end gap-4 md:flex-col md:gap-2.5 sm:flex-col sm:gap-2.5">
                        <button type="button" onclick="closeTaskModal()"
                            class="bg-[#475569] text-white py-3 px-7 border-0 rounded-md cursor-pointer text-[15px] font-semibold transition-all duration-300 hover:bg-[#64748b] hover:-translate-y-0.5 md:w-full md:py-3 md:px-5 sm:w-full sm:py-3 sm:px-5">
                            Cancel
                        </button>
                        <button type="submit"
                            class="bg-gradient-to-br from-[#1abc9c] to-[#16a085] text-white py-3 px-7 border-0 rounded-md cursor-pointer text-[15px] font-semibold transition-all duration-300 hover:bg-gradient-to-br hover:from-[#16a085] hover:to-[#1abc9c] hover:-translate-y-0.5 hover:shadow-[0_5px_15px_rgba(26,188,156,0.3)] md:w-full md:py-3 md:px-5 sm:w-full sm:py-3 sm:px-5">
                            <span id="saveButtonText">Save Task</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let editingTaskId = null;

        // Store sample task data
        const sampleTaskData = {
            101: { 
                title: 'Homepage Redesign', 
                description: 'Update the homepage hero section with new branding and ensure mobile responsiveness.', 
                assignedTo: 'John Doe', 
                dueDate: '2026-01-20', 
                status: 'In Progress' 
            }
        };

        function openCreateTaskModal() {
            editingTaskId = null;
            document.getElementById('taskId').value = '';
            document.getElementById('modalTitle').textContent = 'Create New Task';
            document.getElementById('modalDescription').textContent = 'Fill in the details below to assign a new task.';
            document.getElementById('saveButtonText').textContent = 'Save Task';
            document.getElementById('taskTitle').value = '';
            document.getElementById('taskDesc').value = '';
            document.getElementById('dueDate').value = '';
            document.getElementById('assignMember').value = '';
            document.getElementById('taskStatus').value = 'Pending';
            
            // Change form action to store route
            document.getElementById('taskForm').action = '{{ route('tasks.store') }}';
            document.getElementById('taskModal').style.display = 'block';
        }

        function editTask(task) {
            editingTaskId = task.id;
            document.getElementById('taskId').value = task.id;
            document.getElementById('modalTitle').textContent = 'Edit Task';
            document.getElementById('modalDescription').textContent = 'Update the task details below.';
            document.getElementById('saveButtonText').textContent = 'Update Task';
            document.getElementById('taskTitle').value = task.title;
            document.getElementById('taskDesc').value = task.description || '';
            document.getElementById('dueDate').value = task.due_date || '';
            document.getElementById('assignMember').value = task.assigned_to || '';
            document.getElementById('taskStatus').value = task.status;
            
            // Change form action to update route
            document.getElementById('taskForm').action = '{{ url('tasks') }}/' + task.id;
            document.getElementById('taskModal').style.display = 'block';
        }

        function editTaskSample(id) {
            const task = sampleTaskData[id];
            if (task) {
                editTask({
                    id: id,
                    title: task.title,
                    description: task.description,
                    due_date: task.dueDate,
                    assigned_to: task.assignedTo,
                    status: task.status
                });
            }
        }

        function closeTaskModal() {
            document.getElementById('taskModal').style.display = 'none';
            editingTaskId = null;
        }

        window.onclick = function (event) {
            const modal = document.getElementById('taskModal');
            if (event.target === modal) closeTaskModal();
        }
    </script>

</body>

</html>