import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import './estilos.css'

const CustomButtomComponent = ({ openBy, handleAction, buttonAction }) => {
  return (
    <button className={`${openBy === 'delete' ? 'btnDelete' : 'btnEdit'}`} onClick={handleAction}>
      <FontAwesomeIcon icon={buttonAction} />
    </button>
  )
}

export default CustomButtomComponent
