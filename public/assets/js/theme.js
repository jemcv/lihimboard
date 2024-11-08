function applySavedTheme() {
    // Check if the user has a saved theme in localStorage
    const savedTheme = localStorage.getItem('theme');
    
    // If there's a saved theme, apply it
    if (savedTheme) {
        document.documentElement.setAttribute('data-theme', savedTheme);
    } else {
        // If no saved theme, check the system's prefers-color-scheme
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        document.documentElement.setAttribute('data-theme', systemPrefersDark ? 'dark' : 'light');
    }

    updateThemeButton();
}

// Function to toggle theme between light and dark
function toggleTheme() {
    const htmlElement = document.documentElement;
    const currentTheme = htmlElement.getAttribute('data-theme');
    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
    htmlElement.setAttribute('data-theme', newTheme);

    // Save the selected theme in localStorage
    localStorage.setItem('theme', newTheme);

    updateThemeButton();
}

// Function to update the text on the theme toggle button
function updateThemeButton() {
    const htmlElement = document.documentElement;
    const currentTheme = htmlElement.getAttribute('data-theme');
    const themeButton = document.getElementById('theme-toggle-button');

    if (!themeButton) {
        return;
    }
    
    themeButton.textContent = currentTheme === 'light' ? '🌞' : '🌜';
}

// Apply the saved theme or system preference when the page loads
document.addEventListener('DOMContentLoaded', function () {
    applySavedTheme();
});