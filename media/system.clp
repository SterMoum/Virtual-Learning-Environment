(defclass System
	(is-a USER)
	(role concrete)
	(slot Time
		(type INSTANCE)
		(allowed-classes Cycle)
;+		(cardinality 1 1)
		(create-accessor read-write)))

(defclass Cirquit
	(is-a System)
	(role concrete)
	(slot nameCirquit
		(type STRING)
;+		(cardinality 1 1)
		(create-accessor read-write))
	(multislot getsInputFrom
		(type INSTANCE)
		(allowed-classes Input)
		(cardinality 2 ?VARIABLE)
		(create-accessor read-write))
	(slot hasOutput
		(type INTEGER)
;+		(cardinality 1 1)
		(create-accessor read-write))
	(slot sendsOutputTo
		(type INSTANCE)
		(allowed-classes Sensor)
;+		(cardinality 1 1)
		(create-accessor read-write))
	(multislot hasInput
		(type INTEGER)
		(cardinality 2 ?VARIABLE)
		(create-accessor read-write)))

(defclass Adder "Implements the mathematical operation of: (input_1 + input_2) MOD 32"
	(is-a Cirquit)
	(role concrete))

(defclass Multiplier "Implements the mathematical operation of: (input_1 * input_2) MOD 32"
	(is-a Cirquit)
	(role concrete))

(defclass Input
	(is-a System)
	(role concrete)
	(multislot givesInputTo
		(type INSTANCE)
		(allowed-classes Cirquit)
		(create-accessor read-write))
	(slot inputId
		(type STRING)
;+		(cardinality 1 1)
		(create-accessor read-write))
	(slot value
		(type INTEGER)
;+		(cardinality 0 1)
		(create-accessor read-write)))

(defclass Sensor
	(is-a Input)
	(role concrete)
	(slot getsOutputFrom
		(type INSTANCE)
		(allowed-classes Cirquit)
;+		(cardinality 1 1)
		(create-accessor read-write)))

(defclass NormalInput
	(is-a Input)
	(role concrete))

(defclass Cycle
	(is-a USER)
	(role concrete)
	(slot id
		(type INTEGER)
;+		(cardinality 1 1)
		(create-accessor read-write))
	(multislot inputValue
		(type INTEGER)
		(cardinality 1 ?VARIABLE)
		(create-accessor read-write))
	(multislot sensorValue
		(type INTEGER)
		(cardinality 1 ?VARIABLE)
		(create-accessor read-write)))
		
(definstances facts

([input1_2] of  NormalInput

	(givesInputTo [A1_2])
	(inputId "input1_2")
	(Time [2])
	(value 7))

([A2_3] of  Adder

	(getsInputFrom
		[M2_3]
		[M3_3])
	(hasInput 6 8)
	(hasOutput 14)
	(nameCirquit "A2_3")
	(sendsOutputTo [OUT_3])
	(Time [3]))

([input2_2] of  NormalInput

	(givesInputTo [P1_2])
	(inputId "input2_2")
	(Time [2])
	(value 25))

([A1_2] of  Adder

	(getsInputFrom
		[input1_2]
		[input1_2])
	(hasInput 7 7)
	(hasOutput 0)
	(nameCirquit "A1_2")
	(sendsOutputTo [M1_2])
	(Time [2]))

([A2_2] of  Adder

	(getsInputFrom
		[M2_2]
		[M3_2])
	(hasInput 0 3)
	(hasOutput 3)
	(nameCirquit "A2_2")
	(sendsOutputTo [OUT_2])
	(Time [2]))

([P1_2] of  Multiplier

	(getsInputFrom
		[M1_2]
		[input2_2])
	(hasInput 25 0)
	(hasOutput 0)
	(nameCirquit "P1_2")
	(sendsOutputTo [M2_2])
	(Time [2]))

([1] of  Cycle

	(id 1)
	(inputValue 21 28 10 25)
	(sensorValue 10 24 26 18))

([2] of  Cycle

	(id 2)
	(inputValue 7 25 13 15)
	(sensorValue 10 24 26 18))

([3] of  Cycle

	(id 3)
	(inputValue 11 17 24 31)
	(sensorValue 22 6 8 14))

([4] of  Cycle

	(id 4)
	(inputValue 18 11 28 21)
	(sensorValue 4 12 12 0))

([5] of  Cycle

	(id 5)
	(inputValue 25 24 30 10)
	(sensorValue 18 16 12 12))

([6] of  Cycle

	(id 6)
	(inputValue 12 19 11 19)
	(sensorValue 8 24 17 9))

([7] of  Cycle

	(id 7)
	(inputValue 1 31 7 22)
	(sensorValue 2 0 26 26))

([8] of  Cycle

	(id 8)
	(inputValue 0 31 3 23)
	(sensorValue 0 0 0 0))

([9] of  Cycle

	(id 9)
	(inputValue 31 1 6 8)
	(sensorValue 30 30 0 30))

([10] of  Cycle

	(id 10)
	(inputValue 6 4 25 12)
	(sensorValue 12 31 12 28))

([A1_1] of  Adder

	(getsInputFrom
		[input1_1]
		[input1_1])
	(hasInput 21 21)
	(hasOutput 10)
	(nameCirquit "A1_1")
	(sendsOutputTo [M1_1])
	(Time [1]))

([Circuit_Class10038] of  %3AINSTANCE-ANNOTATION

	(%3AANNOTATED-INSTANCE [Circuit_Class10037])
	(%3AANNOTATION-TEXT "(21 + 21) % (2^5) = 10")
	(%3ACREATION-TIMESTAMP "2022.11.28 16:34:40.542 EET")
	(%3ACREATOR "stert"))

([A2_1] of  Adder

	(getsInputFrom
		[M2_1]
		[M3_1])
	(hasInput 24 26)
	(hasOutput 18)
	(nameCirquit "A2_1")
	(sendsOutputTo [OUT_1])
	(Time [1]))

([P1_1] of  Multiplier

	(getsInputFrom
		[M1_1]
		[input2_1])
	(hasInput 10 28)
	(hasOutput 24)
	(nameCirquit "P1_1")
	(sendsOutputTo [M2_1])
	(Time [1]))

([P2_1] of  Multiplier

	(getsInputFrom
		[input3_1]
		[input4_1])
	(hasInput 10 25)
	(hasOutput 26)
	(nameCirquit "P2_1")
	(sendsOutputTo [M3_1])
	(Time [1]))

([OUT_1] of  Sensor

	(getsOutputFrom [A2_1])
	(inputId "OUT_1")
	(Time [1])
	(value 18))

([M1_1] of  Sensor

	(getsOutputFrom [A1_1])
	(givesInputTo [P1_1])
	(inputId "M1_1")
	(Time [1])
	(value 10))

([M2_1] of  Sensor

	(getsOutputFrom [P1_1])
	(givesInputTo [A2_1])
	(inputId "M2_1")
	(Time [1])
	(value 24))

([M3_1] of  Sensor

	(getsOutputFrom [P2_1])
	(givesInputTo [A2_1])
	(inputId "M3_1")
	(Time [1])
	(value 26))

([input1_1] of  NormalInput

	(givesInputTo [A1_1])
	(inputId "input1_1")
	(Time [1])
	(value 21))

([input2_1] of  NormalInput

	(givesInputTo [P1_1])
	(inputId "input2_1")
	(Time [1])
	(value 28))

([input3_1] of  NormalInput

	(givesInputTo [P2_1])
	(inputId "input3_1")
	(Time [1])
	(value 10))

([input4_1] of  NormalInput

	(givesInputTo [P2_1])
	(inputId "input4_1")
	(Time [1])
	(value 25))

([A1_3] of  Adder

	(getsInputFrom
		[input1_3]
		[input1_3])
	(hasInput 11 11)
	(hasOutput 22)
	(nameCirquit "A1_3")
	(sendsOutputTo [M1_3])
	(Time [3]))

([input3_2] of  NormalInput

	(givesInputTo [P2_2])
	(inputId "input3_2")
	(Time [2])
	(value 13))

([input4_2] of  NormalInput

	(givesInputTo [P2_2])
	(inputId "input4_2")
	(Time [2])
	(value 15))

([M1_2] of  Sensor

	(getsOutputFrom [A1_2])
	(givesInputTo [P1_2])
	(inputId "M1_2")
	(Time [2])
	(value 0))

([M2_2] of  Sensor

	(getsOutputFrom [P1_2])
	(givesInputTo [A2_2])
	(inputId "M2_2")
	(Time [2])
	(value 0))

([M3_2] of  Sensor

	(getsOutputFrom [P2_2])
	(givesInputTo [A2_2])
	(inputId "M3_2")
	(Time [2])
	(value 3))

([OUT_2] of  Sensor

	(getsOutputFrom [A2_2])
	(inputId "OUT_2")
	(Time [2])
	(value 3))

([P2_2] of  Multiplier

	(getsInputFrom
		[input3_2]
		[input4_2])
	(hasInput 13 15)
	(hasOutput 3)
	(nameCirquit "P2_2")
	(sendsOutputTo [M3_2])
	(Time [2]))

([M1_5] of  Sensor

	(getsOutputFrom [A1_5])
	(givesInputTo [P1_5])
	(inputId "M1_5")
	(Time [5])
	(value 18))

([M2_5] of  Sensor

	(getsOutputFrom [P1_5])
	(givesInputTo [A2_5])
	(inputId "M2_5")
	(Time [5])
	(value 16))

([M3_5] of  Sensor

	(getsOutputFrom [P2_5])
	(givesInputTo [A2_5])
	(inputId "M3_5")
	(Time [5])
	(value 12))

([OUT_5] of  Sensor

	(getsOutputFrom [A2_5])
	(inputId "OUT_5")
	(Time [5])
	(value 12))

([A1_5] of  Adder

	(getsInputFrom
		[input1_5]
		[input1_5])
	(hasInput 25 25)
	(hasOutput 18)
	(nameCirquit "A1_5")
	(sendsOutputTo [M1_5])
	(Time [5]))

([A2_5] of  Adder

	(getsInputFrom
		[M2_5]
		[M3_5])
	(hasInput 16 12)
	(hasOutput 12)
	(nameCirquit "A2_5")
	(sendsOutputTo [OUT_5])
	(Time [5]))

([P2_5] of  Multiplier

	(getsInputFrom
		[input3_5]
		[input4_5])
	(hasInput 30 10)
	(hasOutput 12)
	(nameCirquit "P2_5")
	(sendsOutputTo [M3_5])
	(Time [5]))

([P1_5] of  Multiplier

	(getsInputFrom
		[input2_5]
		[M1_5])
	(hasInput 24 18)
	(hasOutput 16)
	(nameCirquit "P1_5")
	(sendsOutputTo [M2_5])
	(Time [5]))

([input4_5] of  NormalInput

	(givesInputTo [P2_5])
	(inputId "input4_5")
	(Time [5])
	(value 10))

([input3_5] of  NormalInput

	(givesInputTo [P2_5])
	(inputId "input3_5")
	(Time [5])
	(value 30))

([input2_5] of  NormalInput

	(givesInputTo [P1_5])
	(inputId "input2_5")
	(Time [5])
	(value 24))

([input1_5] of  NormalInput

	(givesInputTo [A1_5])
	(inputId "input1_5")
	(Time [5])
	(value 25))

([P2_3] of  Multiplier

	(getsInputFrom
		[input3_3]
		[input4_3])
	(hasInput 24 31)
	(hasOutput 8)
	(nameCirquit "P2_3")
	(sendsOutputTo [M3_3])
	(Time [3]))

([Circuit_Class30003] of  Multiplier

	(getsInputFrom
		[Circuit_Class30006]
		[Circuit_Class30011])
	(hasInput 17 22)
	(hasOutput 6)
	(nameCirquit "?1_3")
	(sendsOutputTo [Circuit_Class30010])
	(Time [Circuit_Class10020]))

([input4_3] of  NormalInput

	(givesInputTo [P2_3])
	(inputId "input4_3")
	(Time [3])
	(value 31))

([input3_3] of  NormalInput

	(givesInputTo [P2_3])
	(inputId "input3_3")
	(Time [3])
	(value 24))

([input2_3] of  NormalInput

	(givesInputTo [P1_3])
	(inputId "input2_3")
	(Time [3])
	(value 17))

([input1_3] of  NormalInput

	(givesInputTo [A1_3])
	(inputId "input1_3")
	(Time [3])
	(value 11))

([OUT_3] of  Sensor

	(getsOutputFrom [A2_3])
	(inputId "OUT_3")
	(Time [3])
	(value 14))

([M3_3] of  Sensor

	(getsOutputFrom [Circuit_Class30002])
	(givesInputTo [Circuit_Class10000])
	(inputId "M3_3")
	(Time [Circuit_Class10020])
	(value 8))

([M2_3] of  Sensor

	(getsOutputFrom [P1_3])
	(givesInputTo [A2_3])
	(inputId "M2_3")
	(Time [3])
	(value 6))

([M1_3] of  Sensor

	(getsOutputFrom [A1_3])
	(givesInputTo [P1_3])
	(inputId "M1_3")
	(Time [3])
	(value 22))

([A2_4] of  Adder

	(getsInputFrom
		[M2_4]
		[M3_4])
	(hasInput 12 12)
	(hasOutput 0)
	(nameCirquit "A2_4")
	(sendsOutputTo [OUT_4])
	(Time [4]))

([A1_4] of  Adder

	(getsInputFrom
		[input1_4]
		[input1_4])
	(hasInput 18 18)
	(hasOutput 4)
	(nameCirquit "A1_4")
	(sendsOutputTo [M1_4])
	(Time [4]))

([P1_4] of  Multiplier

	(getsInputFrom
		[input2_4]
		[M1_4])
	(hasInput 11 4)
	(hasOutput 12)
	(nameCirquit "P1_4")
	(sendsOutputTo [M2_4])
	(Time [4]))

([P2_4] of  Multiplier

	(getsInputFrom
		[input3_4]
		[input4_4])
	(hasInput 28 21)
	(hasOutput 12)
	(nameCirquit "P2_4")
	(sendsOutputTo [M3_4])
	(Time [4]))

([input4_4] of  NormalInput

	(givesInputTo [P2_4])
	(inputId "input4_4")
	(Time [4])
	(value 21))

([input3_4] of  NormalInput

	(givesInputTo [P2_4])
	(inputId "input3_4")
	(Time [4])
	(value 28))

([input2_4] of  NormalInput

	(givesInputTo [P1_4])
	(inputId "input2_4")
	(Time [4])
	(value 11))

([input1_4] of  NormalInput

	(givesInputTo [A1_4])
	(inputId "input1_4")
	(Time [4])
	(value 18))

([OUT_4] of  Sensor

	(getsOutputFrom [A2_4])
	(inputId "OUT_4")
	(Time [4])
	(value 0))

([M3_4] of  Sensor

	(getsOutputFrom [P2_4])
	(givesInputTo [A2_4])
	(inputId "M3_4")
	(Time [4])
	(value 12))

([M2_4] of  Sensor

	(getsOutputFrom [P1_4])
	(givesInputTo [A2_4])
	(inputId "M2_4")
	(Time [4])
	(value 12))

([M1_4] of  Sensor

	(getsOutputFrom [A1_4])
	(givesInputTo [P1_4])
	(inputId "M1_4")
	(Time [4])
	(value 4))
)