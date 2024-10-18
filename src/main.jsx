import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import "./index.css";
import "./App.css";
import theme from "./common/constants/theme.json";
import CommonButton from "./common/CommonButton";
("./common/CommonButton");

createRoot(document.getElementById("root")).render(
  <StrictMode>
    <>
      <h1>Hello World</h1>
      <CommonButton
        filled={false}
        inactive={true}
        backgroundColor={theme.colors.error}
        backgroundDark={theme.colors.primaryDark}
        borderColor={theme.colors.primary}
        onPress={() => console.log("button has been pressed!")}
        stretch={true}
        textColor={theme.colors.onPrimary}
      >
        bye
      </CommonButton>
    </>
  </StrictMode>
);
