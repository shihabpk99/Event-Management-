</main>
    <footer>
        <p>&copy; <?= date("Y") ?> EventSphere. All rights reserved.</p>
    </footer>

    <div id="image-modal" class="image-modal">
    <span class="close-modal">&times;</span>
    <img class="modal-content zoomable" id="full-image">
    <span class="nav-arrow left-arrow">&#10094;</span>
    <span class="nav-arrow right-arrow">&#10095;</span>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("image-modal");
    const modalImg = document.getElementById("full-image");
    const close = document.querySelector(".close-modal");
    const leftArrow = document.querySelector(".left-arrow");
    const rightArrow = document.querySelector(".right-arrow");
    const images = Array.from(document.querySelectorAll(".clickable-image"));

    let currentIndex = 0;
    let scale = 1, isDragging = false, startX, startY, scrollLeft, scrollTop;

    function openModal(index) {
        currentIndex = index;
        modal.style.display = "flex";
        modal.classList.add("opening");
        modalImg.src = images[index].src;
        scale = 1;
        modalImg.style.transform = "scale(1)";
        setTimeout(() => modal.classList.remove("opening"), 300);
    }

    function closeModal() {
        modal.style.display = "none";
    }

    function showImage(index) {
        if (index < 0 || index >= images.length) return;
        currentIndex = index;
        modalImg.src = images[currentIndex].src;
        scale = 1;
        modalImg.style.transform = "scale(1)";
    }

    images.forEach((img, i) => {
        img.addEventListener("click", () => openModal(i));
    });

    close.onclick = closeModal;
    window.onclick = (e) => { if (e.target == modal) closeModal(); };

    leftArrow.onclick = () => showImage(currentIndex - 1);
    rightArrow.onclick = () => showImage(currentIndex + 1);

    // Zoom with mouse wheel
    modalImg.addEventListener("wheel", (e) => {
        e.preventDefault();
        const zoom = e.deltaY < 0 ? 0.1 : -0.1;
        scale = Math.max(0.5, Math.min(3, scale + zoom));
        modalImg.style.transform = `scale(${scale})`;
    });

    // Drag to move
    modalImg.addEventListener("mousedown", (e) => {
        isDragging = true;
        startX = e.clientX - modalImg.offsetLeft;
        startY = e.clientY - modalImg.offsetTop;
        modalImg.style.cursor = 'grabbing';
    });

    document.addEventListener("mouseup", () => {
        isDragging = false;
        modalImg.style.cursor = 'grab';
    });

    document.addEventListener("mousemove", (e) => {
        if (!isDragging) return;
        e.preventDefault();
        modalImg.style.position = "relative";
        modalImg.style.left = `${e.clientX - startX}px`;
        modalImg.style.top = `${e.clientY - startY}px`;
    });
});
</script>

<script>
document.querySelectorAll('.clickable-image').forEach(img => {
    img.addEventListener('click', function() {
        const modal = document.getElementById("imageModal");
        const modalImg = document.getElementById("modalImage");
        modal.style.display = "block";
        modalImg.src = this.src;
    });
});
document.querySelector(".close").addEventListener('click', function() {
    document.getElementById("imageModal").style.display = "none";
});
</script>


</body>
</html>
