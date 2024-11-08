document.addEventListener('DOMContentLoaded', function() {
    const colorSelect = document.getElementById('color-select');
    const themeStylesheet = document.getElementById('theme-stylesheet');

    // Function to update the stylesheet link and selected option text
    function updateStylesheet(color) {
        themeStylesheet.href = `https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.${color}.min.css`;
        localStorage.setItem('selectedColor', color);
        if (colorSelect) {
            const emojiMap = {
                red: '🌹',
                pink: '🌸',
                fuchsia: '🌺',
                purple: '🍇',
                violet: '🔮',
                indigo: '🌌',
                blue: '🌊',
                cyan: '🌀',
                jade: '🍃',
                green: '🌿',
                lime: '🍋',
                yellow: '🐝',
                amber: '🍯',
                pumpkin: '🎃',
                orange: '🍊',
                sand: '🏖️',
                grey: '🌫️',
                zinc: '⚙️',
            };
            colorSelect.options[colorSelect.selectedIndex].text = `${color.charAt(0).toUpperCase() + color.slice(1)} ${emojiMap[color]}`;
        }
    }

    // Load the saved color from localStorage
    const savedColor = localStorage.getItem('selectedColor');
    if (savedColor) {
        if (colorSelect) {
            colorSelect.value = savedColor;
        }
        updateStylesheet(savedColor);
    } else {
        // Set default color if no color is saved
        updateStylesheet('sand');
    }

    // Event listener for color select change
    if (colorSelect) {
        colorSelect.addEventListener('change', function() {
            const selectedColor = colorSelect.value;
            if (selectedColor) {
                updateStylesheet(selectedColor);
            }
        });
    }
});