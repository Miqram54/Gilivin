from matplotlib import pyplot as plt
from matplotlib.patches import FancyBboxPatch

# Function to draw a box with text
def draw_box(ax, x, y, width, height, text, fontsize=10):
    box = FancyBboxPatch((x, y), width, height, boxstyle="round,pad=0.2", edgecolor="green", facecolor="white", linewidth=1.5)
    ax.add_patch(box)
    ax.text(x + width / 2, y + height / 2, text, fontsize=fontsize, ha="center", va="center", wrap=True)

# Create figure and axis
fig, ax = plt.subplots(figsize=(10, 5))

# Input Box
draw_box(ax, 0, 0.3, 2, 1, "Input\n- GPS Module\n- Accelerometer\n- Braille Display")

# Process Box
draw_box(ax, 3, 0.3, 2, 1, "Process\n- Navigation Algorithm\n- Braille Translation\n- Feedback Mechanism")

# Output Box
draw_box(ax, 6, 0.3, 2, 1, "Output\n- Vibrations\n- Braille Feedback\n- Audio Guidance")

# Arrows
ax.annotate("", xy=(2, 0.8), xytext=(3, 0.8), arrowprops=dict(arrowstyle="->", lw=1.5, color="black"))
ax.annotate("", xy=(5, 0.8), xytext=(6, 0.8), arrowprops=dict(arrowstyle="->", lw=1.5, color="black"))

# Labels
ax.text(2.5, 1.1, "Relay", fontsize=10, ha="center")
ax.text(5.5, 1.1, "Relay", fontsize=10, ha="center")

# Hide axes
ax.axis("off")

# Show diagram
plt.title("Flow Diagram for MangaiTech Smartwatch", fontsize=12, pad=20)
plt.show()
