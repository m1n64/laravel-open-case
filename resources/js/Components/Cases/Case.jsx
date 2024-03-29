export const Case = ({case_}) => {
    return (
        <a href={route('case.id', {id: case_.id})}>
            <img src={case_.image}/>
            <strong>{case_.name}</strong>
            <p>{case_.description}</p>
        </a>
    )
}
