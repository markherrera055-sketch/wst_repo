import logo from './logo.svg';
import './App.css';
import Card from "./component/Card";
import Counter from "./component/Counter";
import List from "./component/List";

function App() {
  return (
      <>
        <Card
          name = "Mark Daniel"
          description = "This is me."
        />

        <Counter/>
        
        <List />
      </>
  )
}

export default App;
