document.addEventListener("DOMContentLoaded", () => {
  // Load theme from localStorage or default to 'light'
  const savedTheme = localStorage.getItem("theme") || "light";
  const themeToggle = document.getElementById("theme-toggle");

  // Apply the saved theme
  document.documentElement.setAttribute("data-theme", savedTheme);

  // Set the toggle state based on the theme
  themeToggle.checked = savedTheme === "dark";

  // Add event listener to the toggle button
  themeToggle.addEventListener("change", () => {
    const newTheme = themeToggle.checked ? "dark" : "light";
    document.documentElement.setAttribute("data-theme", newTheme);
    localStorage.setItem("theme", newTheme);
  });
});
