import React from 'react';
import './Dashboard.css'; // File CSS untuk styling

const Dashboard = () => {
  return (
    <div className="dashboard">
      {/* Sidebar */}
      <aside className="sidebar">
        <div className="logo">
          <h2>Dashboard</h2>
        </div>
        <nav className="nav-menu">
          <ul>
            <li className="active">
              <i className="icon">📊</i>
              <span>Overview</span>
            </li>
            <li>
              <i className="icon">📈</i>
              <span>Analytics</span>
            </li>
            <li>
              <i className="icon">👥</i>
              <span>Users</span>
            </li>
            <li>
              <i className="icon">📦</i>
              <span>Products</span>
            </li>
            <li>
              <i className="icon">⚙️</i>
              <span>Settings</span>
            </li>
          </ul>
        </nav>
      </aside>

      {/* Main Content */}
      <main className="main-content">
        {/* Header */}
        <header className="header">
          <div className="search-bar">
            <input type="text" placeholder="Search..." />
          </div>
          <div className="user-profile">
            <span>John Doe</span>
            <img src="/avatar.jpg" alt="User" className="avatar" />
          </div>
        </header>

        {/* Content Area */}
        <div className="content">
          <h1>Welcome Back, John!</h1>
          
          {/* Stats Cards */}
          <div className="stats-grid">
            <StatCard 
              title="Total Revenue"
              value="$54,239"
              icon="💰"
              change="+12.5%"
            />
            <StatCard 
              title="Total Users"
              value="8,549"
              icon="👥"
              change="+23.1%"
            />
            <StatCard 
              title="New Orders"
              value="1,423"
              icon="📦"
              change="+8.2%"
            />
            <StatCard 
              title="Conversion Rate"
              value="3.24%"
              icon="📊"
              change="-2.1%"
            />
          </div>

          {/* Charts and Tables */}
          <div className="dashboard-grid">
            <div className="chart-card">
              <h3>Revenue Overview</h3>
              <RevenueChart />
            </div>
            <div className="chart-card">
              <h3>Recent Activity</h3>
              <RecentActivity />
            </div>
          </div>

          <div className="table-card">
            <h3>Recent Orders</h3>
            <OrdersTable />
          </div>
        </div>
      </main>
    </div>
  );
};

// Component untuk Stat Card
const StatCard = ({ title, value, icon, change }) => {
  const isPositive = change.startsWith('+');
  
  return (
    <div className="stat-card">
      <div className="stat-icon">{icon}</div>
      <div className="stat-details">
        <h4>{title}</h4>
        <p className="stat-value">{value}</p>
        <p className={`stat-change ${isPositive ? 'positive' : 'negative'}`}>
          {change} from last month
        </p>
      </div>
    </div>
  );
};

// Component untuk Chart (menggunakan chart library sederhana)
const RevenueChart = () => {
  return (
    <div className="revenue-chart">
      {/* Bisa menggunakan library seperti Recharts atau Chart.js */}
      <div className="chart-placeholder">
        {/* Placeholder untuk chart */}
        <div className="bar" style={{height: '60%'}}></div>
        <div className="bar" style={{height: '80%'}}></div>
        <div className="bar" style={{height: '45%'}}></div>
        <div className="bar" style={{height: '70%'}}></div>
        <div className="bar" style={{height: '90%'}}></div>
        <div className="bar" style={{height: '55%'}}></div>
      </div>
    </div>
  );
};

// Component untuk Recent Activity
const RecentActivity = () => {
  const activities = [
    { id: 1, user: 'Alice', action: 'purchased item', time: '2 min ago' },
    { id: 2, user: 'Bob', action: 'signed up', time: '15 min ago' },
    { id: 3, user: 'Charlie', action: 'uploaded file', time: '1 hour ago' },
    { id: 4, user: 'Diana', action: 'commented', time: '3 hours ago' },
  ];

  return (
    <ul className="activity-list">
      {activities.map(activity => (
        <li key={activity.id}>
          <span className="activity-user">{activity.user}</span>
          <span className="activity-action">{activity.action}</span>
          <span className="activity-time">{activity.time}</span>
        </li>
      ))}
    </ul>
  );
};

// Component untuk Orders Table
const OrdersTable = () => {
  const orders = [
    { id: '#12345', customer: 'John Smith', amount: '$125.00', status: 'Completed' },
    { id: '#12346', customer: 'Jane Doe', amount: '$89.99', status: 'Pending' },
    { id: '#12347', customer: 'Bob Wilson', amount: '$299.99', status: 'Processing' },
    { id: '#12348', customer: 'Alice Brown', amount: '$45.50', status: 'Completed' },
    { id: '#12349', customer: 'Charlie Green', amount: '$678.00', status: 'Shipped' },
  ];

  return (
    <table className="orders-table">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Customer</th>
          <th>Amount</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        {orders.map(order => (
          <tr key={order.id}>
            <td>{order.id}</td>
            <td>{order.customer}</td>
            <td>{order.amount}</td>
            <td>
              <span className={`status-badge ${order.status.toLowerCase()}`}>
                {order.status}
              </span>
            </td>
          </tr>
        ))}
      </tbody>
    </table>
  );
};

export default Dashboard;