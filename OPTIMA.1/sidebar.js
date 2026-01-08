function loadSidebar(activePage, role = 'admin') {
    const sidebarContainer = document.getElementById('sidebar-container');
    if (!sidebarContainer) return;

    let menuItems = '';

    if (role === 'admin') {
        menuItems = `
            <li><a href="admin.html" id="link-home" class="block text-[#8899a6] py-[14px] px-4 no-underline text-base font-medium transition-all duration-300 hover:text-[#1abc9c] hover:bg-[rgba(26,188,156,0.1)] hover:rounded-[5px] max-md:py-[10px] max-md:px-3 max-md:text-sm max-sm:py-[10px] max-sm:px-3 max-sm:text-sm min-[1200px]:text-[17px] min-[1200px]:py-[15px] min-[1200px]:px-[18px] min-[1600px]:text-lg min-[1600px]:py-4 min-[1600px]:px-5">Home</a></li>
            <li><a href="usermanagement.html" id="link-usermanagement" class="block text-[#8899a6] py-[14px] px-4 no-underline text-base font-medium transition-all duration-300 hover:text-[#1abc9c] hover:bg-[rgba(26,188,156,0.1)] hover:rounded-[5px] max-md:py-[10px] max-md:px-3 max-md:text-sm max-sm:py-[10px] max-sm:px-3 max-sm:text-sm min-[1200px]:text-[17px] min-[1200px]:py-[15px] min-[1200px]:px-[18px] min-[1600px]:text-lg min-[1600px]:py-4 min-[1600px]:px-5">User Management</a></li>
            <li><a href="projects.html" id="link-projects" class="block text-[#8899a6] py-[14px] px-4 no-underline text-base font-medium transition-all duration-300 hover:text-[#1abc9c] hover:bg-[rgba(26,188,156,0.1)] hover:rounded-[5px] max-md:py-[10px] max-md:px-3 max-md:text-sm max-sm:py-[10px] max-sm:px-3 max-sm:text-sm min-[1200px]:text-[17px] min-[1200px]:py-[15px] min-[1200px]:px-[18px] min-[1600px]:text-lg min-[1600px]:py-4 min-[1600px]:px-5">Projects</a></li>
        `;
    } else if (role === 'project-manager') {
        menuItems = `
            <li><a href="project_dashboard.html" id="link-dashboard" class="block text-[#8899a6] py-[14px] px-4 no-underline text-base font-medium transition-all duration-300 hover:text-[#1abc9c] hover:bg-[rgba(26,188,156,0.1)] hover:rounded-[5px] max-md:py-[10px] max-md:px-3 max-md:text-sm max-sm:py-[10px] max-sm:px-3 max-sm:text-sm min-[1200px]:text-[17px] min-[1200px]:py-[15px] min-[1200px]:px-[18px] min-[1600px]:text-lg min-[1600px]:py-4 min-[1600px]:px-5">Dashboard</a></li>
            <li><a href="task_monitoring.html" id="link-tasks" class="block text-[#8899a6] py-[14px] px-4 no-underline text-base font-medium transition-all duration-300 hover:text-[#1abc9c] hover:bg-[rgba(26,188,156,0.1)] hover:rounded-[5px] max-md:py-[10px] max-md:px-3 max-md:text-sm max-sm:py-[10px] max-sm:px-3 max-sm:text-sm min-[1200px]:text-[17px] min-[1200px]:py-[15px] min-[1200px]:px-[18px] min-[1600px]:text-lg min-[1600px]:py-4 min-[1600px]:px-5">Task Monitoring</a></li>
        `;
    } else if (role === 'team-member') {
        menuItems = `
            <li><a href="my_tasks.html" id="link-mytasks" class="block text-[#8899a6] py-[14px] px-4 no-underline text-base font-medium transition-all duration-300 hover:text-[#1abc9c] hover:bg-[rgba(26,188,156,0.1)] hover:rounded-[5px] max-md:py-[10px] max-md:px-3 max-md:text-sm max-sm:py-[10px] max-sm:px-3 max-sm:text-sm min-[1200px]:text-[17px] min-[1200px]:py-[15px] min-[1200px]:px-[18px] min-[1600px]:text-lg min-[1600px]:py-4 min-[1600px]:px-5">My Tasks</a></li>
        `;
    }

    sidebarContainer.innerHTML = `
    <nav class="bg-[#1e293b] flex items-center py-[10px] px-10 flex-wrap fixed top-0 left-0 right-0 w-full z-[1000] max-md:py-[10px] max-md:px-5 max-md:flex-col max-md:gap-[15px] max-md:items-start max-sm:py-[10px] max-sm:px-[15px] min-[1200px]:py-[15px] min-[1200px]:px-[60px] min-[1600px]:py-5 min-[1600px]:px-20">
        <div class="flex items-center gap-[10px] max-md:gap-[10px] max-md:mb-[5px] max-sm:gap-2">
            <img src="optima-logo.png" alt="Optima Logo" class="w-10 h-10 mr-0 max-sm:w-[30px] max-sm:h-[30px] min-[1600px]:w-[50px] min-[1600px]:h-[50px]">
            <h1 class="text-2xl font-bold text-white mr-[50px] m-0 max-md:text-xl max-md:mr-0 max-sm:text-lg min-[1200px]:text-[26px] min-[1200px]:mr-[60px] min-[1600px]:text-[28px] min-[1600px]:mr-20">OPTIMA</h1>
        </div>
        <ul class="list-none flex items-center gap-5 ml-auto flex-wrap max-md:ml-0 max-md:w-full max-md:gap-[10px] max-sm:gap-[5px] min-[1200px]:gap-[25px] min-[1600px]:gap-[30px]">
            ${menuItems}
            <span></span>
            <div class="flex gap-[10px] ml-auto items-center max-md:ml-0 max-md:w-full">
                <span class="w-px h-[30px] bg-[rgba(136,153,166,0.3)] mx-[10px] max-md:hidden"></span>
                <li><a href="index.html" class="block text-[#8899a6] py-[14px] px-4 no-underline text-base font-medium transition-all duration-300 hover:text-[#1abc9c] hover:bg-[rgba(26,188,156,0.1)] hover:rounded-[5px] max-md:py-[10px] max-md:px-3 max-md:text-sm max-sm:py-[10px] max-sm:px-3 max-sm:text-sm min-[1200px]:text-[17px] min-[1200px]:py-[15px] min-[1200px]:px-[18px] min-[1600px]:text-lg min-[1600px]:py-4 min-[1600px]:px-5">Logout</a></li>
            </div>
        </ul>
    </nav>
    `;

    // Highlight active link
    if (activePage) {
        const activeLink = document.getElementById(`link-${activePage}`);
        if (activeLink) {
            activeLink.style.color = '#1abc9c';
            activeLink.style.backgroundColor = 'rgba(26, 188, 156, 0.1)';
            activeLink.style.borderRadius = '5px';
        }
    }
}