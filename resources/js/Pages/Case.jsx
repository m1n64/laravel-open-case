import axios from "axios";
import {useEffect, useState} from "react";
import {OpenCase} from "@/Components/Cases/Containers/OpenCase.jsx";

export default function Case({case_, skins}) {

    return (
        <div>
            <h1>{case_.name}</h1>
            <p>{case_.key?.name}</p>

            <OpenCase
                currentCase={case_}
            />

            <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 grid-gap-4">
                {skins.map(skin => <div>
                    <img src={skin.image} alt={skin.name}/>
                    <strong style={{color: skin.rarity.color}}>{skin.name}</strong>
                    <i>{skin.pattern?.name}</i>
                    <span>({skin.category.name})</span>
                    <p>{skin.description}</p>
                </div>) }
            </div>

        </div>
    )
}
