import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import '../styles/CommonStyles.css';  // Import the CSS file

const Login = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [role, setRole] = useState('Admin');  // Default role is Admin
  const navigate = useNavigate();

  const handleSubmit = (e) => {
    e.preventDefault();
    // Handle login logic here
    console.log(`Logging in as ${role}`);
    navigate('/dashboard');
  };

  return (
    <div className="auth-container">
      <div className="auth-overlay"></div> {/* Dark overlay */}

      <div className="auth-form-container">
        <h2>Login</h2>
        <form onSubmit={handleSubmit}>
          <input
            type="email"
            placeholder="Email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
          />
          <input
            type="password"
            placeholder="Password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            required
          />
          <select 
            value={role}
            onChange={(e) => setRole(e.target.value)}  // Update the role state
          >
            <option value="Admin">Admin</option>
            <option value="Manager">Manager</option>
            <option value="Staff">Staff</option>
          </select>
          <button type="submit">Login</button>
        </form>
        <div className="switch-link">
          Don't have an account? <a href="/signup">Sign Up</a>
        </div>
      </div>
    </div>
  );
};

export default Login;
