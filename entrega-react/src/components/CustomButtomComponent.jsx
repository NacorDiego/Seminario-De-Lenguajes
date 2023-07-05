import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import './estilos.css'

const CustomButtomComponent = ({ openBy, handleAction, buttonAction, buttonTitle }) => {
  return (
    <button
      className={`${openBy === 'delete' ? 'btnDelete' : openBy === 'add' ? 'btnAdd' : 'btnEdit'}`}
      onClick={handleAction}
    >
      <FontAwesomeIcon
        icon={buttonAction}
        className={`${openBy === 'add' ? 'btn-AddMargin' : ''}`}
      />
      {buttonTitle}
    </button>
  )
}

export default CustomButtomComponent
