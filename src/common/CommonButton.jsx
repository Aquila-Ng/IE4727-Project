import React from "react";
import theme from "./constants/theme.json"; // Assuming you have a theme file
import Constants from "./constants/Constants"; // Assuming you have constant values defined

const CommonButton = ({
  backgroundColor,
  textColor,
  disabled = false,
  inactive = false,
  filled = true,
  borderColor,
  height = "50px", // Default height
  width,
  children,
  onPress, // onClick handler
}) => {
  const handlePressIn = () => {
    // Optional feedback like hover or shadow on press-in
    console.log("Button Pressed In");
  };

  const handlePressOut = () => {
    // Optional feedback like shadow removal on press-out
    console.log("Button Pressed Out");
  };

  return (
    <button
      style={{
        backgroundColor:
          disabled && filled
            ? theme.colors.surfaceDisabledInvert // Color when disabled
            : backgroundColor, // Use background color passed in props
        color: textColor, // Text color
        height: height, // Dynamic height
        width: width ? width : "auto", // Dynamic width
        border: filled ? "none" : `2px solid ${borderColor || "transparent"}`, // Border based on props
        borderRadius: Constants.radiusSmall, // Rounded corners
        padding: `${Constants.mediumGap}px`, // Padding from constants
        display: "flex", // Flexbox to align content
        alignItems: "center",
        justifyContent: "center",
        cursor: disabled || inactive ? "not-allowed" : "pointer", // Disable pointer when disabled
        opacity: disabled || inactive ? 0.6 : 1, // Reduce opacity if disabled
      }}
      disabled={disabled || inactive} // Disable button if needed
      onClick={disabled || inactive ? undefined : onPress} // Only trigger onClick if not disabled
      onMouseDown={handlePressIn} // Handle press-in event
      onMouseUp={handlePressOut} // Handle press-out event
    >
      {/* Render children (button text) */}
      {children}
    </button>
  );
};

export default CommonButton;
