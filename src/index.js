import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
// import Button from './component/ui/Button';
// import Card from "./component/ui/Card";
// import Counter from "./component/ui/Counter";
// import List from "./component/ui/List";
import Post from "./component/ui/Post";
// import PostCard from "./component/ui/PostCard";
import reportWebVitals from './reportWebVitals';

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    {/* <Button />
    <Card 
        name = "Mark Daniel"
        description = "This is me."/>
    <Counter />
    <List /> */}
    <Post />
    {/* <PostCard /> */}
  </React.StrictMode>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
