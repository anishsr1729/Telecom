import React from 'react';
import { Link } from 'react-router-dom';
import '../styles/Landing.css';  // Import the CSS

const Landing = () => {
  return (
    <div className="landing-container">
      <div className="landing-overlay"></div> {/* Dark overlay */}
      
      <div className="landing-content">
        <h1>Welcome to Our Application</h1>
        <p>Your journey to a better experience starts here. Choose an option below to continue.</p>

        <div className="button-container">
          <Link to="/login">
            <button className="landing-button">Login</button>
          </Link>
          <Link to="/signup">
            <button className="landing-button">Sign Up</button>
          </Link>
        </div>
      </div>
    </div>
  );
};

export default Landing;
