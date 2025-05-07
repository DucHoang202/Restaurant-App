function black(link, event) {
  var row = link.parentNode.parentNode;
  row.classList.add("table", "table-striped", "table-dark");
  event.preventDefault();
  setTimeout(function () {
    window.location.href = link.href;
  }, 500);
}

const anchor = document.getElementById("anchor");
const rekt = anchor.getBoundingClientRect();
const anchorX = rekt.left + rekt.width / 2;
const anchorY = rekt.top + rekt.height / 2;

function angle(cx, cy, ex, ey) {
  const dy = ey - cy;
  const dx = ex - cx;
  const rad = Math.atan2(dy, dx);
  const deg = (rad * 180) / Math.PI;
  return deg;
}

document.addEventListener("mousemove", (e) => {
  const mouseX = e.clientX;
  const mouseY = e.clientY;
  const angleDeg = angle(mouseX, mouseY, anchorX, anchorY);
  const eyesBall = document.querySelectorAll(".eye");
  eyesBall.forEach((eye) => {
    eye.style.transform = `rotate(${angleDeg}deg)`;
    anchor.style.filter = `hue-rotate(${angleDeg}deg)`;
  });
});
