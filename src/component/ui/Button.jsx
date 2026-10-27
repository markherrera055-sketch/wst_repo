
function Button() {
    function click() {
        alert("Click na Boss");
    }

    return (
        <div className="button">
            <h1>Herrera</h1>
            <button onClick={click}>Click Me</button>
        </div>
    );
}

export default Button;