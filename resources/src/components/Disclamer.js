import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import { Button, Dropdown, Form, Modal } from 'react-bootstrap';
import IconCloseModalImage from '../assets/img/icon-close-modal.png';

const Disclamer = () => {
    const [modalStatus, setModalStatus] = useState(true);

    const handleModalStatus = () => {
        setModalStatus(!modalStatus);
    }

    useEffect(()=>{

    }, []);
    return (
        <div className="">
            <Modal show={modalStatus} onHide={handleModalStatus} id="disclamer-modal">
                <Modal.Body>
                    <div className="disclaimer-content">
                        <button type="button" className="close float-end" onClick={handleModalStatus}>
                            <img src={IconCloseModalImage} />
                        </button>
                        <h3 className="text1 mt-2 mb-4">Disclaimer: Use at <br /> Your Own Risk</h3>
                        <div className="row">
                            <div className="col-sm-12 text-block">
                                <p>Curretly in its alpha version, this application serves as a platform for Nodigy services. While every effort has been made to snsure it's functionality, users are advised that errors my arise during it's operation. It is important to not that funds invested in your node are sesure: however, there exists a slight possibility of encountering partial or complete loss of your deposit within your personal account,
                                    We strongly urge users to exercise coutio and refrain form depositiog an amount exceeding the stipulated requirement.
                                    It is crucial to emphasize that the contracts associated with this application have not yet undergone an audit., As such, users are enouraged to exercise discernenebt and prudence when utilizing the platform.
                                    It is crucial to emphasize that the contracts associated with this application have not yet undergone an audit., As such, users are enouraged to exercise discernenebt and prudence when utilizing the platform.
                                    Curretly in its alpha version, this application serves as a platform for Nodigy services. While every effort has been made to snsure it's functionality, users are advised that errors my arise during it's operation. It is important to not that funds invested in your node are sesure: however, there exists a slight possibility of encountering partial or complete loss of your deposit within your personal account,
                                </p>
                            </div>
                        </div>
                        <div className="btn-container">
                            <button type="button" className="btn btn-primary my-4" onClick={handleModalStatus}>I understand</button>
                        </div>
                    </div>
                </Modal.Body>
            </Modal>
        </div>
    )
}
export default Disclamer;