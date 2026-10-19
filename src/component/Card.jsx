
function Card({name, description}){
    return(
        <div className="Card">
            <h1>{name}</h1>
            <p>{description}</p>
        </div>
    );
}
export default Card;