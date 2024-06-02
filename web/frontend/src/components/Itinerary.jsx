import React, { useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";

const Itinerary = () => {
  const [activities, setActivities] = useState({
    dayOne: "",
    dayTwo: "",
    dayThree: "",
    dayFour: "",
    dayFive: "",
  });
  const [currentActivity, setCurrentActivity] = useState("");
  const [selectedDay, setSelectedDay] = useState("dayOne");
  const navigate = useNavigate();

  const handleAddActivity = (e) => {
    e.preventDefault();
    setActivities((prevActivities) => ({
      ...prevActivities,
      [selectedDay]: prevActivities[selectedDay]
        ? `${prevActivities[selectedDay]}, ${currentActivity}`
        : currentActivity,
    }));
    setCurrentActivity("");
  };

  const handleDeleteActivity = (day, activity) => {
    setActivities((prevActivities) => ({
      ...prevActivities,
      [day]: prevActivities[day]
        .split(", ")
        .filter((item) => item !== activity)
        .join(", "),
    }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    axios
      .post("http://localhost:8002/api/activities", activities)
      .then((response) => {
        console.log("Success:", response.data);
        setActivities({
          dayOne: "",
          dayTwo: "",
          dayThree: "",
          dayFour: "",
          dayFive: "",
        });
        setCurrentActivity("");
        setSelectedDay("dayOne");
        navigate("/activities");
      })
      .catch((error) => console.error("Error:", error));
  };

  return (
    <form onSubmit={handleSubmit} className="mb-2" style={{ width: 800 }}>
      <h1>To Do List</h1>
      <div>
        <label htmlFor="day"></label>
        <select
          id="day"
          value={selectedDay}
          onChange={(e) => setSelectedDay(e.target.value)}
        >
          <option value="dayOne">Day One</option>
          <option value="dayTwo">Day Two</option>
          <option value="dayThree">Day Three</option>
          <option value="dayFour">Day Four</option>
          <option value="dayFive">Day Five</option>
        </select>
      </div>
      <div>
        <label htmlFor="activity"></label>
        <input
          id="activity"
          value={currentActivity}
          onChange={(e) => setCurrentActivity(e.target.value)}
          placeholder="To do"
        />
        <button
          onClick={handleAddActivity}
          className="btn btn-primary btn-sm ml-2"
        >
          Add
        </button>
      </div>
      {Object.keys(activities).map((day) =>
        activities[day] ? (
          <div key={day}>
            <h3>{day.replace("day", "Day ")}</h3>
            <ol>
              {activities[day]
                .split(", ")
                .filter((activity) => activity)
                .map((activity, index) => (
                  <li key={index}>
                    {activity}
                    <button
                      onClick={() => handleDeleteActivity(day, activity)}
                      className="btn btn-danger btn-sm ml-2"
                    >
                      Delete
                    </button>
                  </li>
                ))}
            </ol>
          </div>
        ) : null
      )}
      <button className="btn btn-success btn-sm mt-2" type="submit">
        Submit
      </button>
    </form>
  );
};

export default Itinerary;
