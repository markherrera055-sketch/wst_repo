import logo from './logo.svg';
import './App.css';
import Card from "./component/ui/Card";
import Counter from "./component/ui/Counter";
import List from "./component/ui/List";

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
