<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks - {{ config('app.name', 'OPTIMA') }}</title>
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
                loadSidebar('mytasks', 'team-member');
            @endif
        });   
    </script>

    {{-- My Tasks --}}
    <div id="task-page"
        class="bg-cover bg-center min-h-screen flex flex-col justify-start p-[100px_50px] pt-[150px] max-md:p-[60px_30px] max-md:pt-[280px] max-sm:p-[40px_20px] max-sm:pt-[300px]">
        <h1 id="admin" class="text-[48px] mt-0 mb-10 text-center max-md:text-4xl max-sm:text-[28px]">My Tasks</h1>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-500/20 border border-green-500 text-green-200 px-4 py-3 rounded-lg mb-4 mx-[10px]">
                {{ session('success') }}
            </div>
        @endif

        <div
            class="flex justify-between items-center mb-5 px-5 max-md:flex-col max-md:gap-[15px] max-md:text-center max-md:px-[10px]">
            <h3 class="text-white text-2xl m-0 max-md:text-xl max-sm:text-lg">Assigned Tasks</h3>
            <div class="sort-controls">
                <button
                    class="py-2 px-[15px] border-none rounded cursor-pointer text-[13px] transition-all duration-300 font-medium bg-[#34495e] text-white hover:bg-[#2c3e50] max-md:py-2 max-md:px-3 max-md:text-xs max-sm:py-[6px] max-sm:px-[10px] max-sm:text-[11px]"
                    onclick="sortTasks()">
                    <i class="bi bi-sort-down"></i> Priority Sort
                </button>
            </div>
        </div>

        <div class="overflow-x-auto mx-[10px] rounded-lg max-md:mx-0 max-md:rounded-none">
            <table id="myTasksTable" class="w-full border-collapse min-w-[600px]">
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
                            Project</th>
                        <th
                            class="p-[15px] text-left font-semibold text-sm uppercase max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-[11px]">
                            Due Date</th>
                        <th
                            class="p-[15px] text-left font-semibold text-sm uppercase max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-[11px]">
                            Priority</th>
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
                                {{ $task->project->name ?? 'N/A' }}</td>
                            <td
                                class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                {{ $task->due_date ? $task->due_date->format('Y-m-d') : 'N/A' }}</td>
                            <td
                                class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                <span class="inline-block py-[5px] px-3 rounded-[20px] text-xs font-semibold uppercase 
                                    {{ $task->priority === 'High' ? 'bg-[#e74c3c] text-white' : '' }}
                                    {{ $task->priority === 'Medium' ? 'bg-[#f1c40f] text-black' : '' }}
                                    {{ $task->priority === 'Low' ? 'bg-[#3498db] text-white' : '' }}">
                                    {{ $task->priority }}
                                </span>
                            </td>
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
                                        onclick='viewTaskDetail(@json($task))'>View Task Details</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        {{-- Sample Data --}}
                        <tr data-id="201" class="bg-white transition-colors duration-200 hover:bg-[#f8f9fa]">
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">201</td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">Homepage Redesign</td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">Website Redesign</td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">2026-01-20</td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                <span class="inline-block py-[5px] px-3 rounded-[20px] text-xs font-semibold uppercase bg-[#e74c3c] text-white">High</span>
                            </td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                <span class="inline-block py-[5px] px-3 rounded-[20px] text-xs font-semibold uppercase bg-[#d4edda] text-[#155724]">In Progress</span>
                            </td>
                            <td class="p-[15px] border-b border-[#ecf0f1] text-sm text-[#2c3e50] max-md:p-[12px_10px] max-sm:p-[10px_8px] max-sm:text-xs">
                                <div class="flex gap-2 max-md:gap-[6px] max-sm:gap-1">
                                    <button class="py-2 px-[15px] border-none rounded cursor-pointer text-[13px] transition-all duration-300 font-medium bg-[#3498db] text-white hover:bg-[#2980b9] max-md:py-2 max-md:px-3 max-md:text-xs max-sm:py-[6px] max-sm:px-[10px] max-sm:text-[11px] whitespace-nowrap"
                                        onclick="viewTaskDetailSample(201)">View Task Details</button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Task Detail Modal --}}
    <div id="taskDetailModal"
        class="hidden fixed z-[2000] left-0 top-0 w-full h-full overflow-auto bg-[rgba(0,0,0,0.6)] backdrop-blur-[5px]">
        <div
            class="modal-animate bg-white my-[3%] mx-auto p-0 rounded-2xl w-[90%] max-w-[800px] shadow-[0_10px_40px_rgba(0,0,0,0.5)] max-md:w-[95%] max-sm:w-[96%]">
            <div
                class="bg-gradient-to-br from-[#1abc9c] to-[#16a085] text-white p-[20px_25px] rounded-t-2xl flex justify-between items-center max-sm:p-[15px_18px]">
                <h2 class="m-0 text-2xl font-semibold max-md:text-xl max-sm:text-lg">Task Details</h2>
                <span
                    class="text-white text-[32px] font-bold cursor-pointer transition-all duration-300 leading-none flex items-center justify-center w-8 h-8 hover:text-[#f1f1f1] hover:rotate-90 max-sm:text-[28px]"
                    onclick="closeTaskDetailModal()">&times;</span>
            </div>
            <div class="p-[30px_25px] max-md:p-[20px_15px] max-sm:p-[18px_15px]">
                <form id="taskForm" action="{{ route('tasks.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="task_id" id="taskId">
                    
                    <div class="mb-7 text-center text-[#333]">
                        <span id="modalPriority"
                            class="inline-block py-1 px-3 rounded-full text-xs font-semibold uppercase bg-[#e74c3c] text-white">
                            High Priority
                        </span>
                        <h2 id="modalTaskTitle" class="my-4 mx-0 mt-4 mb-2.5 text-[#2c3e50]">Homepage Redesign</h2>
                        <p id="modalDueDate" class="text-[#666] text-sm">Due: Jan 20, 2026</p>
                    </div>

                    <div class="mb-7 bg-[#f8f9fa] p-5 rounded-lg border-l-4 border-[#1abc9c]">
                        <h4 class="mt-0 text-[#2c3e50] mb-2">Description</h4>
                        <p id="modalDescription" class="text-[#555] leading-relaxed">Update the homepage hero section with
                            new branding and ensure mobile responsiveness. The design assets are attached in the project
                            folder.</p>
                    </div>

                    <div class="mb-5">
                        <label for="taskStatus" class="block mb-2 text-[#333] font-medium text-sm">Update Status</label>
                        <select name="status" id="taskStatus"
                            class="w-full py-3 px-4 border-2 border-[#e2e8f0] rounded-md text-[15px] text-[#333] bg-white focus:outline-none focus:border-[#1abc9c] focus:shadow-[0_0_0_3px_rgba(26,188,156,0.1)]">
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Done</option>
                            <option value="Blocked">Blocked</option>
                        </select>
                    </div>

                    <div class="mb-5">
                        <label for="workNotes" class="block mb-2 text-[#333] font-medium text-sm">Final Notes /
                            Comments</label>
                        <textarea name="notes" id="workNotes" placeholder="Describe the work done or add comments..."
                            class="w-full py-3 px-4 border-2 border-[#e2e8f0] rounded-md text-[15px] resize-y min-h-[100px] text-[#333] font-[inherit] bg-white focus:outline-none focus:border-[#1abc9c]"></textarea>
                    </div>

                    <div class="mb-5">
                        <label for="fileUpload" class="block mb-2 text-[#333] font-medium text-sm">Submit Work (File
                            Upload)</label>
                        <div
                            class="border-2 border-dashed border-[#cbd5e1] p-5 text-center rounded-md bg-[#f8fafc] relative cursor-pointer hover:border-[#1abc9c] transition-colors duration-300">
                            <i class="bi bi-cloud-upload text-2xl text-[#64748b]"></i>
                            <p class="mt-2.5 mb-0 text-sm text-[#64748b]" id="fileUploadText">Click to upload or drag files
                                here</p>
                            <input type="file" name="file" id="fileUpload"
                                class="opacity-0 absolute w-full h-full top-0 left-0 cursor-pointer"
                                onchange="handleFileUpload(this)">
                        </div>
                    </div>

                    <div class="mt-7 flex justify-end gap-4 md:flex-col md:gap-2.5 sm:flex-col sm:gap-2.5">
                        <button type="button" onclick="closeTaskDetailModal()"
                            class="bg-[#475569] text-white py-3 px-7 border-0 rounded-md cursor-pointer text-[15px] font-semibold transition-all duration-300 hover:bg-[#64748b] hover:-translate-y-0.5 md:w-full md:py-3 md:px-5 sm:w-full sm:py-3 sm:px-5">
                            Cancel
                        </button>
                        <button type="submit"
                            class="bg-gradient-to-br from-[#1abc9c] to-[#16a085] text-white py-3 px-7 border-0 rounded-md cursor-pointer text-[15px] font-semibold transition-all duration-300 hover:bg-gradient-to-br hover:from-[#16a085] hover:to-[#1abc9c] hover:-translate-y-0.5 hover:shadow-[0_5px_15px_rgba(26,188,156,0.3)] md:w-full md:py-3 md:px-5 sm:w-full sm:py-3 sm:px-5">
                            Submit Work
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let currentTaskId = null;
        let uploadedFile = null;

        // Store task data (for sample/demo purposes)
        const sampleTaskData = {
            201: {
                title: 'Homepage Redesign',
                project: 'Website Redesign',
                dueDate: '2026-01-20',
                priority: 'High',
                status: 'In Progress',
                description: 'Update the homepage hero section with new branding and ensure mobile responsiveness. The design assets are attached in the project folder.'
            }
        };

        function viewTaskDetail(task) {
            currentTaskId = task.id;
            
            // Update modal content
            document.getElementById('taskId').value = task.id;
            document.getElementById('modalTaskTitle').textContent = task.title;
            document.getElementById('modalDueDate').textContent = `Due: ${formatDate(task.due_date)}`;
            document.getElementById('modalDescription').textContent = task.description || 'No description available';
            document.getElementById('taskStatus').value = task.status;

            // Update priority badge
            const priorityBadge = document.getElementById('modalPriority');
            priorityBadge.textContent = `${task.priority} Priority`;

            const priorityClasses = {
                'High': 'bg-[#e74c3c] text-white',
                'Medium': 'bg-[#f1c40f] text-black',
                'Low': 'bg-[#3498db] text-white'
            };
            priorityBadge.className = `inline-block py-1 px-3 rounded-full text-xs font-semibold uppercase ${priorityClasses[task.priority]}`;

            // Reset form
            document.getElementById('workNotes').value = '';
            document.getElementById('fileUpload').value = '';
            document.getElementById('fileUploadText').textContent = 'Click to upload or drag files here';
            uploadedFile = null;

            // Show modal
            document.getElementById('taskDetailModal').style.display = 'block';
        }

        function viewTaskDetailSample(id) {
            const task = sampleTaskData[id];
            if (task) {
                viewTaskDetail({
                    id: id,
                    title: task.title,
                    due_date: task.dueDate,
                    description: task.description,
                    priority: task.priority,
                    status: task.status
                });
            }
        }

        function closeTaskDetailModal() {
            document.getElementById('taskDetailModal').style.display = 'none';
            currentTaskId = null;
            uploadedFile = null;
        }

        function handleFileUpload(input) {
            if (input.files && input.files[0]) {
                uploadedFile = input.files[0];
                document.getElementById('fileUploadText').textContent = `File selected: ${uploadedFile.name}`;
            }
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const options = { month: 'short', day: 'numeric', year: 'numeric' };
            return date.toLocaleDateString('en-US', options);
        }

        function sortTasks() {
            const tbody = document.getElementById('tableBody');
            const rows = Array.from(tbody.querySelectorAll('tr'));

            const priorityOrder = { 'High': 1, 'Medium': 2, 'Low': 3 };

            rows.sort((a, b) => {
                const priorityA = a.querySelector('td:nth-child(5) span').textContent.trim();
                const priorityB = b.querySelector('td:nth-child(5) span').textContent.trim();
                return priorityOrder[priorityA] - priorityOrder[priorityB];
            });

            rows.forEach(row => tbody.appendChild(row));
        }

        window.onclick = function (event) {
            const modal = document.getElementById('taskDetailModal');
            if (event.target === modal) closeTaskDetailModal();
        }
    </script>

</body>

</html>