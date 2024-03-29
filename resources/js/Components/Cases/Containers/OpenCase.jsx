import axios from "axios";
import {useEffect, useState} from "react";
import Modal from "@/Components/Modal.jsx";
import {FocusTrap, Dialog} from "@headlessui/react";

export const OpenCase = ({currentCase}) => {
    const [isOpening, setIsOpening] = useState(false);
    const [isShowModal, setShowModal] = useState(false);
    const [skinsRoulette, setSkinsRoulette] = useState([]);

    Echo.channel('case.'+currentCase.id)
        .listen('.case.open', (e) => {
            setSkinsRoulette([...skinsRoulette, e.skin]);
        });

    useEffect(() => {
        console.log(skinsRoulette)
    }, [skinsRoulette]);

    /**
     * Function to open a case, sets skinsRoulette to an empty array, sets isOpening to true,
     * makes a GET request to open a case by ID, and sets isOpening to false afterwards.
     *
     * @return void
     */
    const openCase = () => {
        setSkinsRoulette([]);
        setIsOpening(true);
        setShowModal(false);

        axios.get('/api/case/open/' + currentCase.id)
            .then(({data}) => {
                setIsOpening(false);
                setShowModal(true);
            })
    }

    return (
        <div>
            <div className={"grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 xl:grid-cols-12 grid-gap-4"}>
                {skinsRoulette.map((el) => (
                    <div style={{backgroundColor: el?.rarity.color}}>
                        <img src={el?.image} alt={el?.name}/>
                    </div>
                ))}
            </div>

            <button disabled={isOpening} className={"p-2 bg-[#FF2D20]/10"} onClick={openCase}>Открыть кейс</button>

            {/*<Modal show={isShowModal}>
                <>
                    HUI
                </>
            </Modal>*/}

        </div>
    )
}
