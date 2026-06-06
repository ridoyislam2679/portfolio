// Run after DOM is ready
document.addEventListener('DOMContentLoaded', function () {
    const wheel = document.getElementById('wheel');
    const spinButton = document.getElementById('spinButton');
	const freeSpinButton = document.getElementById('freeSpinButton');

    const prizes = [
        { text: "2X", color: "#10b981" },
        { text: "1.5X", color: "#3b82f6" },
        { text: "0.5X", color: "#64748b" },
        { text: "JACKPOT", color: "#f59e0b" },
        { text: "1X", color: "#8b5cf6" },
        { text: "0X", color: "#ef4444" },
        { text: "1.2X", color: "#ec4899" },
        { text: "0.8X", color: "#14b8a6" }
    ];

    function createWheel() {
        const sectionAngle = 360 / prizes.length;
        wheel.innerHTML = '';

        prizes.forEach((prize, index) => {
            const section = document.createElement('div');
            section.className = 'wheel-section';
            section.style.transform = `rotate(${index * sectionAngle}deg)`;
            section.style.backgroundColor = prize.color;

            const content = document.createElement('div');
            content.className = 'wheel-section-content';
            content.textContent = prize.text;
            section.appendChild(content);

            wheel.appendChild(section);
        });
    }

    createWheel();
	
	// free spain
	freeSpinButton.addEventListener('click', function (e) {
		const spinAngle = 1800 + Math.floor(Math.random() * 360);
		wheel.style.transition = 'transform 4s ease-out';
		wheel.style.transform = `rotate(${spinAngle}deg)`;

		e.preventDefault();
		setTimeout(() => {
			document.getElementById('freeSpinForm').submit();
		}, 600);
	});

    // Add spin effect before submitting form
    spinButton.addEventListener('click', function (e) {
        const spinAngle = 1800 + Math.floor(Math.random() * 360);
        wheel.style.transition = 'transform 4s ease-out';
        wheel.style.transform = `rotate(${spinAngle}deg)`;

        // Let the wheel spin visually for 500ms before form submit
        e.preventDefault();
        setTimeout(() => {
            spinButton.closest('form').submit();
        }, 600);
    });
});
