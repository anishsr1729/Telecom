import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import '../styles/CommonStyles.css';  // Import the CSS file

const Signup = () => {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [role, setRole] = useState('Admin');  // Default role is Admin
  const navigate = useNavigate();

  const handleSubmit = (e) => {
    e.preventDefault();
    // Handle signup logic here
    console.log(`Signing up as ${role}`);
    navigate('/login');
  };

  return (
    <div className="auth-container">
      <div className="auth-overlay"></div> {/* Dark overlay */}

      <div className="auth-form-container">
        <h2>Sign Up</h2>
        <form onSubmit={handleSubmit}>
          <input
            type="text"
            placeholder="Name"
            value={name}
            onChange={(e) => setName(e.target.value)}
            required
          />
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
          <button type="submit">Sign Up</button>
        </form>
        <div className="switch-link">
          Already have an account? <a href="/login">Login</a>
        </div>
      </div>
    </div>
  );
};

export default Signup;
