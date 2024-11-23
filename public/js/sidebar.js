const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

// Function to set active menu item
function setActiveMenuItem(item) {
	allSideMenu.forEach(i => {
		i.parentElement.classList.remove('active');
	});
	item.parentElement.classList.add('active');
	// Store the active menu item in localStorage
	localStorage.setItem('activeMenu', item.getAttribute('href'));
}

// Set active menu item on page load based on localStorage
document.addEventListener('DOMContentLoaded', () => {
	const activeMenu = localStorage.getItem('activeMenu');
	if (activeMenu) {
		const activeItem = document.querySelector(`#sidebar .side-menu.top li a[href="${activeMenu}"]`);
		if (activeItem) {
			setActiveMenuItem(activeItem);
		}
	}
});

allSideMenu.forEach(item => {
	item.addEventListener('click', function (e) {
		// Uncomment the next line to prevent default navigation for testing
		// e.preventDefault();
		setActiveMenuItem(item);
	});
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})







const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})

if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}

window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})